<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pais;
use App\Models\Menu;
use App\Models\Permiso;

class PaisController extends Controller
{
    public function index()
    {
        $menu = Menu::where('route', Route::currentRouteName())->pluck('id')->first();

        if (Permiso::where('rol_id', Auth::user()->rol_id)->where('menu_id', $menu)->first()) {
            return view('sistema.interno.paises.inicio');
        }

        return redirect('home');
    }

    public function buscar(Request $request)
    {
        $paises = Pais::where('activo', 'S');
        if (Auth::user()->rol_id != 1) {
            $paises->where('id', Auth::user()->pais_id);
        }

        if ($request->search) {
            $search = $request->search;
            
            $paises->where(function ($query) use ($search){
                $query->where('nombre', 'LIKE', "%{$search}%")
                ->orWhere('codigo', 'LIKE', "%{$search}%");
            });
        }

        $paises = $paises->orderBy('nombre', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $paises->total(),
                'current_page' => $paises->currentPage(),
                'per_page' => $paises->perPage(),
                'last_page' => $paises->lastPage(),
                'from' => $paises->firstItem(),
                'to' => $paises->lastPage(),
                'index' => ($paises->currentPage()-1)*$paises->perPage(),
            ],
            'paises' => $paises,
        ];
    }

    public function store(Request $request)
    {
        $request->replace($this->null_string($request->all()));

        $this->validate($request, [
            'codigo' => 'max:10',
            'codigo_telefono' => 'required|min:2|max:5',
            'nombre' => 'required|min:4|max:255'
        ]);

        try {

            if ($request->nombre === 'null' || $request->nombre === ' ') {
                return [
                    'action'    =>  'error',
                    'title'     =>  'Atención!!',
                    'message'   =>  'El Pais no se registró, el nombre no puede estar vacío.',
                ];
            }

            DB::beginTransaction();
            
            $pais = new Pais();

            if ($request->hasFile('bandera')) {
                $file = $request->file('bandera');
                $extension = $file->getClientOriginalExtension();
                $fileContent = 'pais_'.time().'.'.$extension;
                Storage::putFileAs('public/paises/', $file, $fileContent);

                $pais->bandera = $fileContent;
            }

            $pais->codigo = Str::upper($request->codigo);
            $pais->codigo_tel = $request->codigo_telefono;
            $pais->nombre = $request->nombre;
            $pais->token = Str::uuid();
            $pais->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Pais se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Pais, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $request->replace($this->null_string($request->all()));

        $this->validate($request, [
            'codigo' => 'max:10',
            'codigo_telefono' => 'required|min:2|max:5',
            'nombre' => 'required|min:4|max:255'
        ]);

        try {

            if ($request->nombre === 'null' || $request->nombre === ' ') {
                return [
                    'action'    =>  'error',
                    'title'     =>  'Atención!!',
                    'message'   =>  'El Pais no se registró, el nombre no puede estar vacío.',
                ];
            }

            DB::beginTransaction();

            $pais = Pais::findOrFail($request->id);

            if ($request->hasFile('bandera')) {
                $anterior = $pais->bandera;

                $file = $request->file('bandera');
                $extension = $file->getClientOriginalExtension();
                $fileContent = 'pais_'.time().'.'.$extension;
                Storage::putFileAs('public/paises/', $file, $fileContent);
                Storage::delete('public/paises/'.$anterior);

                $pais->bandera = $fileContent;
            }

            $pais->codigo = Str::upper($request->codigo);
            $pais->codigo_tel = $request->codigo_telefono;
            $pais->nombre = $request->nombre;
            $pais->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Pais se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Pais, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $pais = Pais::findOrFail($request->id);
            $pais->activo = 'N';
            $pais->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Pais se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al eliminar el Pais, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
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
