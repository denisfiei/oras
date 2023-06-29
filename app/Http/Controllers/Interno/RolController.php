<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Permiso;
use App\Models\Rol;

class RolController extends Controller
{
    public function index()
    {
        $menu = Menu::where('route', Route::currentRouteName())->pluck('id')->first();

        if (Permiso::where('rol_id', Auth::user()->rol_id)->where('menu_id', $menu)->first()) {
            return view('sistema.interno.roles.inicio');
        }

        return redirect('home');
    }

    public function datos(Request $request)
    {
        /*$menus = Menu::where('activo', 'S')->orderBy('id', 'ASC')->orderBy('orden', 'ASC');

        $administrativos = clone $menus;
        $operativos = clone $menus;
        $sistemas = clone $menus;*/
        
        $roles = Rol::where('activo', 'S')
        ->with(['administrativos', 'operativos', 'sistemas'])
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
            /*'administrativos' => $administrativos->where('categoria', 'A')->with('')->get(),
            'operativos' => $operativos->where('categoria', 'O')->get(),
            'sistemas' => $sistemas->where('categoria', 'S')->get()*/
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

    public function permisos($id)
    {
        $rol = Rol::find($id);
        $menus = Menu::where('activo', 'S')
        ->orderBy('id', 'ASC')
        ->orderBy('orden', 'ASC');

        if ($rol) {
            $menus->with(['permiso' => function ($query) use ($rol) {
                $query->where('rol_id', $rol->id)
                ->select('id', 'rol_id', 'menu_id', 'activo');
            }]);
        }

        $administrativos = clone $menus;
        $operativos = clone $menus;
        $sistemas = clone $menus;

        return [
            'administrativos' => $administrativos->where('categoria', 'A')->get(),
            'operativos' => $operativos->where('categoria', 'O')->get(),
            'sistemas' => $sistemas->where('categoria', 'S')->get()
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
            $rol->nombre = Str::upper($request->nombre);
            $rol->save();

            $user = Auth::user()->id;

            foreach ($request->administrativos as $a) {
                $pa = $a['permiso'] ?? null;
                if ($pa) {
                    if ($a['permiso']['activo'] == 'S') {
                        $adm = new Permiso();
                        $adm->rol_id = $rol->id;
                        $adm->menu_id = $a['permiso']['menu_id'];
                        $adm->activo = 'S';
                        $adm->user_id = $user;
                        $adm->save();
                    }
                }
            }
            foreach ($request->operativos as $a) {
                $po = $a['permiso'] ?? null;
                if ($po) {
                    if ($a['permiso']['activo'] == 'S') {
                        $adm = new Permiso();
                        $adm->rol_id = $rol->id;
                        $adm->menu_id = $a['permiso']['menu_id'];
                        $adm->activo = 'S';
                        $adm->user_id = $user;
                        $adm->save();                 
                    }
                }
            }
            foreach ($request->sistemas as $a) {
                $ps = $a['permiso'] ?? null;
                if ($ps) {
                    if ($a['permiso']['activo'] == 'S') {
                        $adm = new Permiso();
                        $adm->rol_id = $rol->id;
                        $adm->menu_id = $a['permiso']['menu_id'];
                        $adm->activo = 'S';
                        $adm->user_id = $user;
                        $adm->save();
                    }
                }
            }

            $this->store_cache($rol->id);

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
            $rol->nombre = Str::upper($request->nombre);
            $rol->save();

            $user = Auth::user()->id;

            foreach ($request->administrativos as $a) {
                if ($a['permiso']) {
                    if ($a['permiso']['activo'] == 'S') {
                        if ($a['permiso']['id']) {
                            $adm = Permiso::find($a['permiso']['id']);
                            $adm->activo = 'S';
                            $adm->save();
                        } else {
                            $adm = new Permiso();
                            $adm->rol_id = $a['permiso']['rol_id'];
                            $adm->menu_id = $a['permiso']['menu_id'];
                            $adm->activo = 'S';
                            $adm->user_id = $user;
                            $adm->save();
                        }
                    } else {
                        if ($a['permiso']['id']) {
                            Permiso::destroy($a['permiso']['id']);
                        }                    
                    }
                }
            }
            foreach ($request->operativos as $a) {
                if ($a['permiso']) {
                    if ($a['permiso']['activo'] == 'S') {
                        if ($a['permiso']['id']) {
                            $adm = Permiso::find($a['permiso']['id']);
                            $adm->activo = 'S';
                            $adm->save();
                        } else {
                            $adm = new Permiso();
                            $adm->rol_id = $a['permiso']['rol_id'];
                            $adm->menu_id = $a['permiso']['menu_id'];
                            $adm->activo = 'S';
                            $adm->user_id = $user;
                            $adm->save();
                        }
                    } else {
                        if ($a['permiso']['id']) {
                            Permiso::destroy($a['permiso']['id']);
                        }                    
                    }
                }
            }
            foreach ($request->sistemas as $a) {
                if ($a['permiso']) {
                    if ($a['permiso']['activo'] == 'S') {
                        if ($a['permiso']['id']) {
                            $adm = Permiso::find($a['permiso']['id']);
                            $adm->activo = 'S';
                            $adm->save();
                        } else {
                            $adm = new Permiso();
                            $adm->rol_id = $a['permiso']['rol_id'];
                            $adm->menu_id = $a['permiso']['menu_id'];
                            $adm->activo = 'S';
                            $adm->user_id = $user;
                            $adm->save();
                        }
                    } else {
                        if ($a['permiso']['id']) {
                            Permiso::destroy($a['permiso']['id']);
                        }                    
                    }
                }
            }

            $this->update_cache($rol->id);

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

    private function store_cache($id)
    {
        $menu_cache = 'menu_rol_'.$id;

        $menus = Menu::where('activo', 'S')
        ->whereHas('permiso', function ($q) use ($id) {
            $q->where('rol_id', $id);
        })
        ->with(['permiso' => function ($query) use ($id) {
            $query->where('rol_id', $id)
            ->select('id', 'rol_id', 'menu_id', 'activo');
        }])
        ->orderBy('id', 'ASC')
        ->orderBy('orden', 'ASC');

        $administrativos = clone $menus;
        $operativos = clone $menus;
        $sistemas = clone $menus;

        $data_cache = [
            'administrativos' => $administrativos->where('categoria', 'A')->get(),
            'operativos' => $operativos->where('categoria', 'O')->get(),
            'sistemas' => $sistemas->where('categoria', 'S')->get()
        ];
        Cache::forever($menu_cache, $data_cache);
        return;
    }
    
    private function update_cache($id)
    {
        $menu_cache = 'menu_rol_'.$id;

        if( Cache::has($menu_cache) ) {

            Cache::forget($menu_cache);

            $menus = Menu::where('activo', 'S')
            ->whereHas('permiso', function ($q) use ($id) {
                $q->where('rol_id', $id);
            })
            ->with(['permiso' => function ($query) use ($id) {
                $query->where('rol_id', $id)
                ->select('id', 'rol_id', 'menu_id', 'activo');
            }])
            ->orderBy('id', 'ASC')
            ->orderBy('orden', 'ASC');


            $administrativos = clone $menus;
            $operativos = clone $menus;
            $sistemas = clone $menus;

            $data_cache = [
                'administrativos' => $administrativos->where('categoria', 'A')->get(),
                'operativos' => $operativos->where('categoria', 'O')->get(),
                'sistemas' => $sistemas->where('categoria', 'S')->get()
            ];
            Cache::forever($menu_cache, $data_cache);
            return;
        }

        $this->store_cache($id);
        return;
    }
}
