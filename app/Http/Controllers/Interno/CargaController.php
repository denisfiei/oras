<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Carga;
use App\Models\Virus;
use App\Models\TipoMuestreo;
use App\Models\CargaGisaid;
use App\Models\CargaDetalle;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Imports\RowsImport;
use App\Imports\CargaGisaidImport;
use App\Imports\CargaDetalleImport;

class CargaController extends Controller
{
    public function index()
    {
        return view('sistema.interno.cargas.inicio');
    }

    public function datos(Request $request)
    {
        $virus = Virus::where('activo', 'S')->get();
        $cargas = Carga::where('activo', 'S')->with(['pais', 'virus'])->orderBy('id', 'DESC')->paginate(10);

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
                $query->where('archivo_gisaid', 'LIKE', "%{$search}%")
                ->where('archivo_detalle', 'LIKE', "%{$search}%");
            });
        }

        $cargas = $cargas->with(['pais', 'virus'])->orderBy('id', 'DESC')->paginate(10);

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

            $carga = Carga::findOrFail($request->id);
            $carga->activo = 'N';
            $carga->save();

            if ($carga->tipo == 1) {
                CargaGisaid::where('carga_id', $request->id)->delete();
            }
            
            if ($carga->tipo == 2) {
                CargaDetalle::where('carga_id', $request->id)->delete();
            }

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

    public function datos_gisaid(Request $request)
    {
        $gisaids = CargaGisaid::where('carga_id', $request->id)
        ->get();

        return $gisaids;
    }
    
    public function datos_detalle(Request $request)
    {
        $detalles = CargaDetalle::where('carga_id', $request->id)
        ->get();

        return $detalles;
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
    
    public function gisaid(Request $request)
    {
        $request->replace($this->null_string($request->all()));

        $this->validate($request, [
            'virus' => 'required|exists:virus,id',
            'file' => ['required', 'mimes:xlsx'],
            'cantidad' => 'required|min:1',
        ]);

        try {
            DB::beginTransaction();
            
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileContent = 'cargas/gisaid/arch_'.time().'.'.$extension;
            Storage::putFileAs('public/', $file, $fileContent);

            $carga = new Carga();
            $carga->virus_id = $request->virus;
            $carga->pais_id = Auth::user()->pais_id;
            $carga->archivo_gisaid = $fileName;
            $carga->file_gisaid = $fileContent;
            $carga->cantidad_gisaid = $request->cantidad;
            $carga->user_id = Auth::user()->id;
            $carga->save();

            $import = new CargaGisaidImport($carga);
            Excel::import($import, request()->file('file'));
            $data = $import->getData();

            if (count($data['errors']) > 0) {
                $errors = [];
                foreach ($data['errors'] as $key => $value) {
                    $errors[] = '#'.($key+1).', Fila: '.$value['fila'].', Error: '.$value['error'];
                }
                $contenido = implode("\n", $errors);
                $log_file = "cargas/gisaid/logs/log_".time().".log";
                Storage::put('public/'.$log_file, $contenido);

                $carga->log_gisaid = $log_file;
                $carga->error_gisaid = $data['total_error'];
            }
            $carga->cantidad_gisaid = $data['total'];
            $carga->save();

            DB::commit();
    
            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'Se importaron los Datos con éxito.',
                'import'    =>  $data
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            Storage::delete('public/'.$fileContent);

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al importar los Datos, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'import'    =>  $data,
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
    
    public function detalle(Request $request)
    {
        $request->replace($this->null_string($request->all()));

        $this->validate($request, [
            //'muestreo' => 'required|exists:tipo_muestreos,id',
            'file' => ['required', 'mimes:xlsx'],
            'cantidad' => 'required|min:1',
        ]);

        try {
            DB::beginTransaction();
            
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileContent = 'cargas/detalle/arch_'.time().'.'.$extension;
            Storage::putFileAs('public/', $file, $fileContent);

            $carga = Carga::findOrFail($request->id);
            $carga->archivo_detalle = $fileName;
            $carga->file_detalle = $fileContent;
            $carga->cantidad_detalle = $request->cantidad;
            $carga->user_id = Auth::user()->id;
            $carga->save();

            $import = new CargaDetalleImport($carga);
            Excel::import($import, request()->file('file'));
            $data = $import->getData();

            if (count($data['errors']) > 0) {
                $errors = [];
                foreach ($data['errors'] as $key => $value) {
                    $errors[] = '#'.($key+1).', Fila: '.$value['fila'].', '.implode(",", $value['error']);
                }
                $contenido = implode("\n", $errors);
                $log_file = "cargas/detalle/logs/log_".time().".log";
                Storage::put('public/'.$log_file, $contenido);

                $carga->log_detalle = $log_file;
                $carga->error_detalle = $data['total_error'];
            }
            $carga->cantidad_detalle = $data['total'];
            $carga->save();

            DB::commit();
    
            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'Se importaron los Datos con éxito.',
                'import'    =>  $data
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            Storage::delete('public/'.$fileContent);

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