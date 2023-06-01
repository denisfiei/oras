<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Recurso;
use App\Models\Pais;
use App\Models\Centro;

class RecursoController extends Controller
{
    public function index()
    {
        //dd(is_string($pais) && $pais === 'null' ? null : $pais);
        return view('sistema.interno.recursos.inicio');
    }

    public function datos()
    {
        $paises = Pais::where('activo', 'S')->get();
        $centros = Centro::where('activo', 'S')->get();

        $recursos = Recurso::where('activo', 'S')->with(['pais', 'centro'])->orderBy('titulo', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $recursos->total(),
                'current_page' => $recursos->currentPage(),
                'per_page' => $recursos->perPage(),
                'last_page' => $recursos->lastPage(),
                'from' => $recursos->firstItem(),
                'to' => $recursos->lastPage(),
                'index' => ($recursos->currentPage()-1)*$recursos->perPage(),
            ],
            'recursos' => $recursos,
            'paises' => $paises,
            'centros' => $centros,
        ];
    }

    public function buscar(Request $request)
    {
        $recursos = Recurso::where('activo', 'S');

        if ($request->search) {
            $search = $request->search;
            
            $recursos->where(function ($query) use ($search){
                $query->where('titulo', 'LIKE', "%{$search}%");
            });
        }
        
        if ($request->nivel) {
            $recursos->where('nivel', $request->nivel);
        }

        $recursos = $recursos->with(['pais', 'centro'])->orderBy('titulo', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $recursos->total(),
                'current_page' => $recursos->currentPage(),
                'per_page' => $recursos->perPage(),
                'last_page' => $recursos->lastPage(),
                'from' => $recursos->firstItem(),
                'to' => $recursos->lastPage(),
                'index' => ($recursos->currentPage()-1)*$recursos->perPage(),
            ],
            'recursos' => $recursos,
        ];
    }

    public function store(Request $request)
    {
        $request->replace($this->null_string($request->all()));
        
        if ($request->nivel >= 20) {
            $this->validate($request, [
                'pais' => 'required|exists:paises,id',
                'centro' => 'required|exists:centros,id',
                'titulo' => 'required|max:255',
                'fecha' => 'required|date|max:255',
                'orden' => 'numeric|min:1',
                'nivel' => 'numeric|min:1',
                'enlace' => 'max:255',
                'imagen' => 'file|max:2048',
            ]);
        } else if ($request->nivel < 20 && $request->nivel >= 10) {
            $this->validate($request, [
                'pais' => 'required|exists:paises,id',
                'titulo' => 'required|max:255',
                'fecha' => 'required|date|max:255',
                'orden' => 'numeric|min:1',
                'nivel' => 'numeric|min:1',
                'enlace' => 'max:255',
                'imagen' => 'file|max:2048',
            ]);
        } else {
            $this->validate($request, [
                'titulo' => 'required|max:255',
                'fecha' => 'required|date|max:255',
                'orden' => 'numeric|min:1',
                'nivel' => 'numeric|min:1',
                'enlace' => 'max:255',
                'imagen' => 'file|max:2048',
            ]);
        }

        try {
            DB::beginTransaction();
            
            $recurso = new Recurso();
            $recurso->pais_id = $request->pais;
            $recurso->centro_id = $request->centro;
            $recurso->titulo = Str::upper($request->titulo);
            $recurso->descripcion = $request->descripcion;
            $recurso->fecha = $request->fecha;
            $recurso->orden = $request->orden;
            $recurso->nivel = $request->nivel;
            $recurso->enlace = $request->enlace;
            
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombre = 'REC_'.time().'.'.$imagen->getClientOriginalExtension();
                Storage::putFileAs('public/recursos/', $imagen, $nombre);
                
                $recurso->ruta = 'recursos';
                $recurso->imagen = $nombre;
            }
            $recurso->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Recurso se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Recurso, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $request->replace($this->null_string($request->all()));

        if ($request->nivel >= 20) {
            $this->validate($request, [
                'pais' => 'required|exists:paises,id',
                'centro' => 'required|exists:centros,id',
                'titulo' => 'required|max:255',
                'fecha' => 'required|date|max:255',
                'orden' => 'numeric|min:1',
                'nivel' => 'numeric|min:1',
                'enlace' => 'max:255',
            ]);
        } else if ($request->nivel < 20 && $request->nivel >= 10) {
            $this->validate($request, [
                'pais' => 'required|exists:paises,id',
                'titulo' => 'required|max:255',
                'fecha' => 'required|date|max:255',
                'orden' => 'numeric|min:1',
                'nivel' => 'numeric|min:1',
                'enlace' => 'max:255',
            ]);
        } else {
            $this->validate($request, [
                'titulo' => 'required|max:255',
                'fecha' => 'required|date|max:255',
                'orden' => 'numeric|min:1',
                'nivel' => 'numeric|min:1',
                'enlace' => 'max:255',
            ]);
        }

        try {

            DB::beginTransaction();

            $recurso = Recurso::findOrFail($request->id);
            $recurso->pais_id = $request->pais;
            $recurso->centro_id = $request->centro;
            $recurso->titulo = Str::upper($request->titulo);
            $recurso->descripcion = $request->descripcion;
            $recurso->fecha = $request->fecha;
            $recurso->orden = $request->orden;
            $recurso->nivel = $request->nivel;
            $recurso->enlace = $request->enlace;
            
            if ($request->hasFile('imagen')) {
                $anterior = $recurso->imagen;

                $imagen = $request->file('imagen');
                $nombre = 'REC_'.time().'.'.$imagen->getClientOriginalExtension();
                Storage::putFileAs('public/recursos/', $imagen, $nombre);
                Storage::delete('public/recursos/'.$anterior);
                
                $recurso->ruta = 'recursos';
                $recurso->imagen = $nombre;
            }
            $recurso->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Recurso se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Recurso, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $lab = Recurso::findOrFail($request->id);
            $lab->activo = 'N';
            $lab->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Recurso se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al eliminar el Recurso, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
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
