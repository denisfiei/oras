<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Aviso;

class AvisoController extends Controller
{
    public function index()
    {
        return view('sistema.interno.avisos.inicio');
    }

    public function buscar(Request $request)
    {
        $avisos = Aviso::query();

        if ($request->search) {
            $search = $request->search;
            
            $avisos->where(function ($query) use ($search){
                $query->where('titulo', 'LIKE', "%{$search}%")
                ->orWhere('descripcion', 'LIKE', "%{$search}%");
            });
        }
        $avisos = $avisos->orderBy('titulo', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $avisos->total(),
                'current_page' => $avisos->currentPage(),
                'per_page' => $avisos->perPage(),
                'last_page' => $avisos->lastPage(),
                'from' => $avisos->firstItem(),
                'to' => $avisos->lastPage(),
                'index' => ($avisos->currentPage()-1)*$avisos->perPage(),
            ],
            'avisos' => $avisos,
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

            $aviso = new Aviso();
            $aviso->titulo = Str::upper($request->titulo);
            $aviso->descripcion = $request->descripcion;
            $aviso->boton = $request->boton;
            $aviso->link = $request->link;
            if (($request->boton === 'null')) {
                $aviso->boton = null;
                $aviso->link = null;
            }
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                $fileContent = 'avisos/av_'.time().'.'.$extension;
                Storage::putFileAs('public/', $file, $fileContent);
                $aviso->imagen = $fileContent;
            }
            $aviso->mostrar = $request->mostrar;
            $aviso->solo_imagen = $request->solo_imagen;
            $aviso->user_id = Auth::user()->id;
            $aviso->save();

            if($request->mostrar === 'S') {
                Aviso::where('id', '!=', $aviso->id)->update(['mostrar' => 'N']);
            }

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Aviso se registró con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Aviso, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
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

            $aviso = Aviso::findOrFail($request->id);
            $aviso->titulo = Str::upper($request->titulo);
            $aviso->descripcion = $request->descripcion;
            $aviso->boton = $request->boton;
            $aviso->link = $request->link;
            if (($request->boton === 'null')) {
                $aviso->boton = null;
                $aviso->link = null;
            }
            if ($request->hasFile('imagen')) {
                $anterior = $aviso->imagen;
                
                $file = $request->file('imagen');
                $extension = $file->getClientOriginalExtension();
                $fileContent = 'avisos/car_'.time().'.'.$extension;
                Storage::putFileAs('public/', $file, $fileContent);
                Storage::delete('public/'.$anterior);

                $aviso->imagen = $fileContent;
            }
            $aviso->mostrar = $request->mostrar;
            $aviso->solo_imagen = $request->solo_imagen;
            $aviso->user_id = Auth::user()->id;
            $aviso->save();


            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Aviso se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Aviso, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $aviso = Aviso::findOrFail($request->id);
            Storage::delete('public/'.$aviso->imagen);
            $aviso->delete();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Aviso se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al eliminar el Aviso, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
