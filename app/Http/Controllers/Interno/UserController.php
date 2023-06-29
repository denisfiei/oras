<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Permiso;
use App\Models\User;
use App\Models\Pais;
use App\Models\Rol;
use App\Models\Laboratorio;

class UserController extends Controller
{
    public function index()
    {
        $menu = Menu::where('route', Route::currentRouteName())->pluck('id')->first();

        if (Permiso::where('rol_id', Auth::user()->rol_id)->where('menu_id', $menu)->first()) {
            return view('sistema.interno.users.inicio');
        }

        return redirect('home');
    }

    public function datos()
    {
        $paises = Pais::where('activo', 'S')->get();
        $roles = Rol::where('activo', 'S')->get();
        $laboratorios = Laboratorio::where('activo', 'S')->get();
        $users = User::with(['rol', 'pais', 'laboratorio'])->orderBy('nombres', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastPage(),
                'index' => ($users->currentPage()-1)*$users->perPage(),
            ],
            'users' => $users,
            'paises' => $paises,
            'roles' => $roles,
            'laboratorios' => $laboratorios,
        ];
    }

    public function buscar(Request $request)
    {
        $users = User::query();

        if ($request->search) {
            $search = $request->search;
            
            $users->where(function ($query) use ($search){
                $query->where('nombres', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $users = $users->with(['rol', 'pais', 'laboratorio'])->orderBy('nombres', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastPage(),
                'index' => ($users->currentPage()-1)*$users->perPage(),
            ],
            'users' => $users,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'perfil' => 'required|exists:roles,id',
            'pais' => 'required|exists:paises,id',
            'laboratorio' => 'required|exists:laboratorios,id',
            'nombres' => 'required|max:255',
            'codigo' => 'required|max:5',
            'telefono' => 'required|digits:9',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|min:6',
        ]);

        try {

            DB::beginTransaction();

            $user = new User();
            $user->rol_id = $request->perfil;
            $user->pais_id = $request->pais;
            $user->laboratorio_id = $request->laboratorio;
            $user->nombres = Str::upper($request->nombres);
            $user->codigo_tel = $request->codigo;
            $user->telefono = $request->telefono;
            $user->email = Str::lower($request->email);
            $user->password = Hash::make($request->password);
            $user->token = Str::random(50);
            $user->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Usuario se registró con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear al Usuario, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'perfil' => 'required|exists:roles,id',
            'pais' => 'required|exists:paises,id',
            'laboratorio' => 'required|exists:laboratorios,id',
            'nombres' => 'required|max:255',
            'codigo' => 'required|max:5',
            'telefono' => 'required|digits:9',
            'email' => 'required|email|unique:users,id,'.$request->id.'|max:50',
            //'password' => 'min:6',
        ]);

        try {

            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $user->rol_id = $request->perfil;
            $user->pais_id = $request->pais;
            $user->laboratorio_id = $request->laboratorio;
            $user->nombres = Str::upper($request->nombres);
            $user->codigo_tel = $request->codigo;
            $user->telefono = $request->telefono;
            $user->email = Str::lower($request->email);
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Usuario se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar al Usuario, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $user->activo = 'N';
            $user->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Usuario se dio de BAJA con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al dar de BAJA al Usuario, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
    
    public function alta(Request $request)
    {
        try {

            DB::beginTransaction();

            $user = User::findOrFail($request->id);
            $user->activo = 'S';
            $user->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Usuario se dio de ALTA con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al dar de ALTA al Usuario, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
