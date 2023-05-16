<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Carga;
use App\Models\Virus;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Imports\RowsImport;
use App\Imports\CargaGisaidImport;

class CargaController extends Controller
{
    public function index()
    {
        return view('sistema.interno.cargas.inicio');
    }

    public function datos(Request $request)
    {
        $virus = Virus::where('activo', 'S')->get();
        $cargas = Carga::where('activo', 'S')->with('virus')->orderBy('id', 'DESC')->paginate(10);

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
            'virus' => $virus
        ];
    }
    
    public function buscar(Request $request)
    {
        $cargas = Carga::where('activo', 'S');

        if ($request->search) {
            $search = $request->search;
            
            $cargas->where(function ($query) use ($search){
                $query->where('virus', 'LIKE', "%{$search}%");
            });
        }

        $cargas = $cargas->with('virus')->orderBy('id', 'DESC')->paginate(10);

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|max:20',
            'nombre' => 'required|max:50',
        ]);

        try {
            DB::beginTransaction();
            
            $carga = new Carga();
            $carga->codigo = Str::upper($request->codigo);
            $carga->nombre = Str::upper($request->nombre);
            $carga->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Carga se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Carga, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|max:20',
            'nombre' => 'required|max:50',
        ]);

        try {

            DB::beginTransaction();

            $carga = Carga::findOrFail($request->id);
            $carga->codigo = Str::upper($request->codigo);
            $carga->nombre = Str::upper($request->nombre);
            $carga->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Carga se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Carga, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $carga = Carga::findOrFail($request->id);
            $carga->activo = 'N';
            $carga->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Carga se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el Carga, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
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
            'virus' => 'required|exists:virus,id',
            'tipo' => 'required|digits_between:1,2',
            'file' => ['required', 'mimes:xlsx'],
            'cantidad' => 'required|min:1',
        ]);

        try {
            DB::beginTransaction();
            
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $tipo = 'detalle';
            if ($request->tipo == 1 || $request->tipo == '1') {
                $tipo = 'gisaid';
            }
            $fileContent = 'cargas/'.$tipo.'/arch_'.time().'.'.$extension;
            Storage::putFileAs('public/', $file, $fileContent);

            $carga = new Carga();
            $carga->virus_id = $request->virus;
            $carga->archivo = $fileContent;
            $carga->cantidad = $request->cantidad;
            $carga->tipo = $request->tipo;
            $carga->user_id = Auth::user()->id;
            $carga->save();

            DB::commit();

            /*$import = new CargaGisaidImport();
            Excel::import($import, request()->file('file'));
            $data = $import->getData();*/
    
            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'Se importaron los Datos con éxito.',
                //'import'    =>  $data
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
