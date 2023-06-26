<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Rol;

class RolController extends Controller
{
    public function index()
    {
        return view('sistema.interno.roles.inicio');
    }

    public function datos(Request $request)
    {
        $menus = Menu::where('activo', 'S')->orderBy('id', 'ASC')->orderBy('orden', 'ASC');

        $administrativos = clone $menus;
        $operativos = clone $menus;
        $sistemas = clone $menus;
        
        $roles = Rol::where('activo', 'S')
        ->withCount('users')
        ->withCount('permisos')
        ->orderBy('id', 'ASC')
        ->paginate(10);

        return [
            'pagination' => [
                'total' => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page' => $roles->perPage(),
                'last_page' => $roles->lastPage(),
                'from' => $roles->firstItem(),
                'to' => $roles->lastPage(),
                'index' => ($roles->currentPage()-1)*$roles->perPage(),
            ],
            'roles' => $roles,
            'administrativos' => $administrativos->where('categoria', 'A')->get(),
            'operativos' => $operativos->where('categoria', 'O')->get(),
            'sistemas' => $sistemas->where('categoria', 'S')->get()
        ];
    }

    public function buscar(Request $request)
    {
        $roles = Rol::where('activo', 'S')
        ->withCount('users')
        ->withCount('permisos');

        if ($request->search) {
            $search = $request->search;
            
            $roles->where(function ($query) use ($search){
                $query->where('nombre', 'LIKE', "%{$search}%");
            });
        }

        $roles = $roles->orderBy('id', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page' => $roles->perPage(),
                'last_page' => $roles->lastPage(),
                'from' => $roles->firstItem(),
                'to' => $roles->lastPage(),
                'index' => ($roles->currentPage()-1)*$roles->perPage(),
            ],
            'roles' => $roles,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:255',
        ]);

        try {
            DB::beginTransaction();
            
            $rol = new Rol();
            $rol->categoria = $request->categoria;
            $rol->nombre = $request->nombre;
            $rol->icono = $request->icono;
            $rol->route = $request->route;
            $rol->url = $request->url;
            $rol->orden = $request->orden;
            $rol->user_id = Auth::user()->id;
            $rol->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Rol se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Rol, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
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

            $rol = Rol::findOrFail($request->id);
            $rol->categoria = $request->categoria;
            $rol->nombre = $request->nombre;
            $rol->icono = $request->icono;
            $rol->route = $request->route;
            $rol->url = $request->url;
            $rol->orden = $request->orden;
            $rol->user_id = Auth::user()->id;
            $rol->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Rol se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Rol, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $rol = Rol::findOrFail($request->id);
            $rol->activo = 'N';
            $rol->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Rol se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el Rol, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
