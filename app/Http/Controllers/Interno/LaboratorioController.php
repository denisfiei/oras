<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Laboratorio;
use App\Models\Pais;
use App\Models\Menu;
use App\Models\Permiso;

class LaboratorioController extends Controller
{
    public function index()
    {
        $menu = Menu::where('route', Route::currentRouteName())->pluck('id')->first();

        if (Permiso::where('rol_id', Auth::user()->rol_id)->where('menu_id', $menu)->first()) {
            return view('sistema.interno.laboratorios.inicio');
        }

        return redirect('home');
    }

    public function datos()
    {
        $paises = Pais::where('activo', 'S')->get();
        $laboratorios = Laboratorio::where('activo', 'S')->with('pais')->orderBy('id', 'DESC')->paginate(10);

        return [
            'pagination' => [
                'total' => $laboratorios->total(),
                'current_page' => $laboratorios->currentPage(),
                'per_page' => $laboratorios->perPage(),
                'last_page' => $laboratorios->lastPage(),
                'from' => $laboratorios->firstItem(),
                'to' => $laboratorios->lastPage(),
                'index' => ($laboratorios->currentPage()-1)*$laboratorios->perPage(),
            ],
            'laboratorios' => $laboratorios,
            'paises' => $paises,
        ];
    }

    public function buscar(Request $request)
    {
        $laboratorios = Laboratorio::where('activo', 'S');

        if ($request->search) {
            $search = $request->search;
            
            $laboratorios->where(function ($query) use ($search){
                $query->where('nombre', 'LIKE', "%{$search}%")
                ->orWhere('codigo', 'LIKE', "%{$search}%");
            });
        }

        if ($request->pais) {
            $laboratorios->where('pais_id', $request->pais);
        }

        $laboratorios = $laboratorios->with('pais')->orderBy('id', 'DESC')->paginate(10);

        return [
            'pagination' => [
                'total' => $laboratorios->total(),
                'current_page' => $laboratorios->currentPage(),
                'per_page' => $laboratorios->perPage(),
                'last_page' => $laboratorios->lastPage(),
                'from' => $laboratorios->firstItem(),
                'to' => $laboratorios->lastPage(),
                'index' => ($laboratorios->currentPage()-1)*$laboratorios->perPage(),
            ],
            'laboratorios' => $laboratorios,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'pais' => 'required|exists:paises,id',
            'codigo' => 'max:10',
            'nombre' => 'required|max:255',
            'direccion' => 'max:255',
            'email' => 'max:50',
            'codigo_tel' => 'requiered|min:2|max:5',
            'telefono' => 'required|digits:9'
        ]);

        try {
            DB::beginTransaction();
            
            $lab = new Laboratorio();
            $lab->pais_id = $request->pais;
            $lab->codigo = Str::upper($request->codigo);
            $lab->nombre = Str::upper($request->nombre);
            $lab->direccion = Str::upper($request->direccion);
            $lab->email = Str::lower($request->email);
            $lab->codigo_tel = $request->codigo_telefono;
            $lab->telefono = $request->telefono;
            $lab->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Labortorio se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Labortorio, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'pais' => 'required|exists:paises,id',
            'codigo' => 'max:10',
            'nombre' => 'required|max:255',
            'direccion' => 'max:255',
            'email' => 'max:50',
            'codigo_tel' => 'requiered|min:2|max:5',
            'telefono' => 'required|digits:9'
        ]);

        try {

            DB::beginTransaction();

            $lab = Laboratorio::findOrFail($request->id);
            $lab->pais_id = $request->pais;
            $lab->codigo = Str::upper($request->codigo);
            $lab->nombre = Str::upper($request->nombre);
            $lab->direccion = Str::upper($request->direccion);
            $lab->email = Str::lower($request->email);
            $lab->codigo_tel = $request->codigo_telefono;
            $lab->telefono = $request->telefono;
            $lab->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Labortorio se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Labortorio, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $lab = Laboratorio::findOrFail($request->id);
            $lab->activo = 'N';
            $lab->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Labortorio se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al eliminar el Labortorio, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
