<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Permiso;
use App\Models\Centro;

class CentroController extends Controller
{
    public function index()
    {
        $menu = Menu::where('route', Route::currentRouteName())->pluck('id')->first();

        if (Permiso::where('rol_id', Auth::user()->rol_id)->where('menu_id', $menu)->first()) {
            return view('sistema.interno.centros.inicio');
        }

        return redirect('home');
    }

    public function buscar(Request $request)
    {
        $centros = Centro::where('activo', 'S');

        if ($request->search) {
            $search = $request->search;
            
            $centros->where(function ($query) use ($search){
                $query->where('nombre', 'LIKE', "%{$search}%");
            });
        }

        $centros = $centros->orderBy('nombre', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $centros->total(),
                'current_page' => $centros->currentPage(),
                'per_page' => $centros->perPage(),
                'last_page' => $centros->lastPage(),
                'from' => $centros->firstItem(),
                'to' => $centros->lastPage(),
                'index' => ($centros->currentPage()-1)*$centros->perPage(),
            ],
            'centros' => $centros,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:255',
        ]);

        try {
            DB::beginTransaction();
            
            $centro = new Centro();
            $centro->nombre = Str::upper($request->nombre);
            $centro->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Centro se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Centro, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:255',
        ]);

        try {

            DB::beginTransaction();

            $centro = Centro::findOrFail($request->id);
            $centro->nombre = Str::upper($request->nombre);
            $centro->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Centro se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Centro, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $centro = Centro::findOrFail($request->id);
            $centro->activo = 'N';
            $centro->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Centro se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el Centro, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
