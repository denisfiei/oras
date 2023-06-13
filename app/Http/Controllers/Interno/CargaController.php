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
use App\Imports\CargaTsvGisaidImport;
use App\Imports\CargaTsvDetalleImport;

class CargaController extends Controller
{
    public function index()
    {
        return view('sistema.interno.cargas.inicio');
    }

    public function datos(Request $request)
    {
        $virus = Virus::where('activo', 'S')->get();
        $cargas = Carga::where('activo', '<>', 'N')->with(['pais', 'virus'])->orderBy('id', 'DESC')->paginate(10);

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
        $cargas = Carga::where('activo', '<>', 'N');

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

    public function publicado(Request $request)
    {
        try {

            DB::beginTransaction();

            $carga = Carga::findOrFail($request->id);
            $carga->activo = $request->estado;
            $carga->user_id = Auth::user()->id;
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
                'message'   =>  'Ocurrio un error al actualizar la Carga, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $carga = Carga::findOrFail($request->id);
            $file_gisaid = $carga->file_gisaid;
            $log_gisaid = $carga->log_gisaid;
            $file_detalle = $carga->file_detalle;
            $log_detalle = $carga->log_detalle;

            $carga->archivo_gisaid = null;
            $carga->file_gisaid = null;
            $carga->cantidad_gisaid = 0;
            $carga->log_gisaid = null;
            $carga->error_gisaid = 0;
            $carga->archivo_detalle = null;
            $carga->file_detalle = null;
            $carga->cantidad_detalle = 0;
            $carga->log_detalle = null;
            $carga->error_detalle = 0;
            $carga->activo = 'N';
            $carga->user_id = Auth::user()->id;
            $carga->save();

            CargaGisaid::where('carga_id', $request->id)->delete();
            Storage::delete('public/'.$file_gisaid);
            if ($log_gisaid) {
                Storage::delete('public/'.$log_gisaid);
            }

            if ($file_detalle) {
                CargaDetalle::where('carga_id', $request->id)->delete();
                Storage::delete('public/'.$file_detalle);

                if ($log_detalle) {
                    Storage::delete('public/'.$log_detalle);
                }
            }

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'La Carga se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar la Carga, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
    
    public function delete_detalle(Request $request)
    {
        try {

            DB::beginTransaction();

            $carga = Carga::findOrFail($request->id);
            $file_detalle = $carga->file_detalle;
            $log_detalle = $carga->log_detalle;
            
            $carga->archivo_detalle = null;
            $carga->file_detalle = null;
            $carga->cantidad_detalle = 0;
            $carga->log_detalle = null;
            $carga->error_detalle = 0;
            $carga->user_id = Auth::user()->id;
            $carga->save();

            CargaDetalle::where('carga_id', $request->id)->delete();

            Storage::delete('public/'.$file_detalle);
            if ($log_detalle) {
                Storage::delete('public/'.$log_detalle);
            }

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Detalle se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el Detalle, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
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
            'file' => ['required', 'mimes:tsv,txt'],
        ]);

        $import = new RowsImport();
        Excel::import($import, request()->file('file'), \Maatwebsite\Excel\Excel::TSV);
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
            'file' => ['required', 'mimes:tsv,txt'],
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

            $import = new CargaTsvGisaidImport($carga);
            Excel::import($import, request()->file('file'), \Maatwebsite\Excel\Excel::TSV);
            $data = $import->getData();

            if (count($data['errors']) > 0) {
                $errors = [];

                $errors[] = 'ERROR CARGA GISAID: '.$fileName;
                $errors[] = '--------------------------------------------------';
                $errors[] = 'Total de errores: '.$data['total_error'];
                $errors[] = '';

                foreach ($data['errors'] as $key => $value) {
                    $errors[] = '#'.($key+1).','."\t".' Fila: '.$value['fila'].','."\t".implode(",\t", $value['error']);
                }
                $contenido = implode("\n", $errors);
                $log_file = "cargas/gisaid/logs/log_".time().".log";
                Storage::put('public/'.$log_file, $contenido);

                $carga->log_gisaid = $log_file;
                $carga->error_gisaid = $data['total_error'];
                $carga->cantidad_gisaid = $data['total'];
                $carga->activo = 'N';
                $carga->save();

                CargaGisaid::where('carga_id', $carga->id)->delete();

                DB::commit();

                Storage::delete('public/'.$fileContent);

                return [
                    'action'    =>  'warning',
                    'title'     =>  'Incorrecto!!',
                    'message'   =>  'El archivo importado contiene errores, Verifique el archivo de Log para más detalles.',
                    'import'    =>  $data,
                    'log'       =>  $log_file
                ];
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
        } catch (\Throwable $th) {
            DB::rollBack();

            Storage::delete('public/'.$fileContent);

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al importar los Datos, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$th->getMessage(),
                'import'    =>  $data,
                'error'     =>  'Error: '.$th
            ];
        }
    }
    
    public function detalle(Request $request)
    {
        $request->replace($this->null_string($request->all()));

        $this->validate($request, [
            //'muestreo' => 'required|exists:tipo_muestreos,id',
            'file' => ['required', 'mimes:tsv,txt'],
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

            $import = new CargaTsvDetalleImport($carga);
            Excel::import($import, request()->file('file'), \Maatwebsite\Excel\Excel::TSV);
            $data = $import->getData();

            if (count($data['errors']) > 0) {
                $errors = [];

                $errors[] = 'ERROR CARGA DETALLE: '.$fileName;
                $errors[] = '--------------------------------------------------';
                $errors[] = 'Total de errores: '.$data['total_error'];
                $errors[] = '';

                foreach ($data['errors'] as $key => $value) {
                    $errors[] = '#'.($key+1).','."\t".' Fila: '.$value['fila'].','."\t".implode(",\t", $value['error']);
                }
                $contenido = implode("\n", $errors);
                $log_file = "cargas/detalle/logs/log_".time().".log";
                Storage::put('public/'.$log_file, $contenido);

                $carga->log_detalle = $log_file;
                $carga->error_detalle = $data['total_error'];
                $carga->cantidad_detalle = $data['total'];
                $carga->activo = 'N';
                $carga->save();

                CargaDetalle::where('carga_id', $carga->id)->delete();

                DB::commit();

                Storage::delete('public/'.$fileContent);

                return [
                    'action'    =>  'warning',
                    'title'     =>  'Incorrecto!!',
                    'message'   =>  'El archivo importado contiene errores, Verifique el archivo de Log para más detalles.',
                    'import'    =>  $data,
                    'log'       =>  $log_file
                ];
            }

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
