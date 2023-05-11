<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Carusel;

class CaruselController extends Controller
{
    public function index()
    {
        return view('sistema.interno.carusel.inicio');
    }

    public function buscar(Request $request)
    {
        $caruseles = Carusel::query();

        if ($request->search) {
            $search = $request->search;
            
            $caruseles->where(function ($query) use ($search){
                $query->where('titulo', 'LIKE', "%{$search}%")
                ->orWhere('descripcion', 'LIKE', "%{$search}%");
            });
        }
        $caruseles = $caruseles->orderBy('titulo', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $caruseles->total(),
                'current_page' => $caruseles->currentPage(),
                'per_page' => $caruseles->perPage(),
                'last_page' => $caruseles->lastPage(),
                'from' => $caruseles->firstItem(),
                'to' => $caruseles->lastPage(),
                'index' => ($caruseles->currentPage()-1)*$caruseles->perPage(),
            ],
            'caruseles' => $caruseles,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|min:4|max:100',
            'descripcion' => 'required|min:5|max:255',
            'boton' => 'max:50',
            'link' => 'max:255',
            //'imagen' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'mostrar' => 'required|max:1'
        ]);

        try {

            DB::beginTransaction();

            $carusel = new Carusel();
            $carusel->titulo = Str::upper($request->titulo);
            $carusel->resaltar = $request->resaltar;
            $carusel->descripcion = $request->descripcion;
            $carusel->boton = $request->boton;
            $carusel->link = $request->link;
            if (($request->boton === 'null' || $request->boton === ' ')) {
                $carusel->boton = null;
                $carusel->link = null;
            }
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                $fileContent = 'carusel/car_'.time().'.'.$extension;
                Storage::putFileAs('public/', $file, $fileContent);
                $carusel->imagen = $fileContent;
            }
            $carusel->mostrar = $request->mostrar;
            $carusel->user_id = Auth::user()->id;
            $carusel->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Carusel se registró con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Carusel, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|min:4|max:100',
            'descripcion' => 'required|min:5|max:255',
            'boton' => 'max:50',
            'link' => 'max:255',
            //'imagen' => 'mimes:png,jpg,jpeg,webp|max:2048',
            'mostrar' => 'required|max:1'
        ]);

        try {

            DB::beginTransaction();

            $carusel = Carusel::findOrFail($request->id);
            $carusel->titulo = Str::upper($request->titulo);
            $carusel->descripcion = $request->descripcion;
            $carusel->boton = $request->boton;
            $carusel->link = $request->link;
            if (($request->boton === 'null' || $request->boton === ' ')) {
                $carusel->boton = null;
                $carusel->link = null;
            }
            if ($request->hasFile('imagen')) {
                $anterior = $carusel->imagen;
                
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                $fileContent = 'carusel/car_'.time().'.'.$extension;
                Storage::putFileAs('public/', $file, $fileContent);
                Storage::delete('public/'.$anterior);

                $carusel->imagen = $fileContent;
            }
            $carusel->mostrar = $request->mostrar;
            $carusel->user_id = Auth::user()->id;
            $carusel->save();


            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Carusel se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Carusel, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $carusel = Carusel::findOrFail($request->id);
            Storage::delete('public/'.$carusel->imagen);
            $carusel->delete();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Carusel se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al eliminar el Carusel, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
