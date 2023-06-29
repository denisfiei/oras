<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Permiso;
use App\Models\CargaLinaje;
use App\Models\Linaje;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Imports\RowsImport;
use App\Imports\CargaLinajeImport;

class LinajeController extends Controller
{
    public function index()
    {
        $menu = Menu::where('route', Route::currentRouteName())->pluck('id')->first();

        if (Permiso::where('rol_id', Auth::user()->rol_id)->where('menu_id', $menu)->first()) {
            return view('sistema.interno.linajes.inicio');
        }

        return redirect('home');
    }

    public function buscar(Request $request)
    {
        $cargas = CargaLinaje::where('activo', '<>', 'I');

        if ($request->search) {
            $search = $request->search;
            
            $cargas->where(function ($query) use ($search){
                $query->where('archivo', 'LIKE', "%{$search}%");
            });
        }

        $cargas = $cargas->orderBy('id', 'DESC')->paginate(10);

        return [
            'pagination' => [
                'total' => $cargas->total(),
                'current_page' => $cargas->currentPage(),
                'per_page' => $cargas->perPage(),
                'last_page' => $cargas->lastPage(),
                'from' => $cargas->firstItem(),
                'to' => $cargas->lastPage(),
                'index' => ($cargas->currentPage()-1)*$cargas->perPage(),
            ],
            'cargas' => $cargas,
        ];
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $carga = CargaLinaje::findOrFail($request->id);
            $carga->activo = 'I';
            $carga->save();

            Linaje::where('carga_linaje_id', $request->id)->delete();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Linaje se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el Linaje, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function carga(Request $request)
    {
        $linajes = Linaje::where('carga_linaje_id', $request->id)
        ->get();

        return $linajes;
    }

    public function rows(Request $request)
    {
        $request->replace($this->null_string($request->all()));

        request()->validate([
            'file' => ['required', 'mimes:xlsx'],
        ]);

        $import = new RowsImport();
        Excel::import($import, request()->file('file'));
        $data = $import->getData();

        return [
            'action' => 'success',
            'rows' => $data
        ];
    }

    public function import(Request $request)
    {
        $request->replace($this->null_string($request->all()));

        $this->validate($request, [
            'file' => ['required', 'mimes:xlsx'],
            'cantidad' => 'required|min:1',
        ]);

        try {
            DB::beginTransaction();
            
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileContent = 'carga_linajes/arch_'.time().'.'.$extension;
            Storage::putFileAs('public/', $file, $fileContent);
            
            $linajes = Linaje::where('activo', 'S')->update(['activo' => 'N']);
            $carga_old = CargaLinaje::where('activo', 'S')->update(['activo' => 'N']);

            $carga = new CargaLinaje();
            $carga->archivo = $fileName;
            $carga->file = $fileContent;
            $carga->cantidad = $request->cantidad;
            $carga->user_id = Auth::user()->id;
            $carga->save();

            $import = new CargaLinajeImport($carga->id);
            Excel::import($import, request()->file('file'));
            $data = $import->getData();

            DB::commit();
    
            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'Se importaron los Datos con éxito.',
                'import'    =>  $data
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al importar los Datos, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function null_string($data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value) && $value === 'null') {
                $data[$key] = null;
            }
        }

        return $data;
    }
}
