<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::where('route', Route::currentRouteName())->pluck('id')->first();

        if (Permiso::where('rol_id', Auth::user()->rol_id)->where('menu_id', $menu)->first()) {
            return view('sistema.interno.menus.inicio');
        }

        return redirect('home');
    }

    public function buscar(Request $request)
    {
        $menus = Menu::where('activo', 'S');

        if ($request->search) {
            $search = $request->search;
            
            $menus->where(function ($query) use ($search){
                $query->where('nombre', 'LIKE', "%{$search}%");
            });
        }

        $menus = $menus->orderBy('id', 'ASC')->orderBy('orden', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $menus->total(),
                'current_page' => $menus->currentPage(),
                'per_page' => $menus->perPage(),
                'last_page' => $menus->lastPage(),
                'from' => $menus->firstItem(),
                'to' => $menus->lastPage(),
                'index' => ($menus->currentPage()-1)*$menus->perPage(),
            ],
            'menus' => $menus,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:255',
        ]);

        try {
            DB::beginTransaction();
            
            $menu = new Menu();
            $menu->categoria = $request->categoria;
            $menu->nombre = $request->nombre;
            $menu->icono = $request->icono;
            $menu->route = $request->route;
            $menu->url = $request->url;
            $menu->orden = $request->orden;
            $menu->user_id = Auth::user()->id;
            $menu->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Menu se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Menu, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
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

            $menu = Menu::findOrFail($request->id);
            $menu->categoria = $request->categoria;
            $menu->nombre = $request->nombre;
            $menu->icono = $request->icono;
            $menu->route = $request->route;
            $menu->url = $request->url;
            $menu->orden = $request->orden;
            $menu->user_id = Auth::user()->id;
            $menu->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Menu se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Menu, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $menu = Menu::findOrFail($request->id);
            $menu->activo = 'N';
            $menu->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Menu se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el Menu, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
