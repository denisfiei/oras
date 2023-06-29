<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TipoMuestreo;
use App\Models\Menu;
use App\Models\Permiso;

class MuestreoController extends Controller
{
    public function index()
    {
        $menu = Menu::where('route', Route::currentRouteName())->pluck('id')->first();

        if (Permiso::where('rol_id', Auth::user()->rol_id)->where('menu_id', $menu)->first()) {
            return view('sistema.interno.muestreos.inicio');
        }

        return redirect('home');
    }

    public function buscar(Request $request)
    {
        $muestreos = TipoMuestreo::where('activo', 'S');

        if ($request->search) {
            $search = $request->search;
            
            $muestreos->where(function ($query) use ($search){
                $query->where('nombre', 'LIKE', "%{$search}%")
                ->where('codigo', 'LIKE', "%{$search}%");
            });
        }

        $muestreos = $muestreos->orderBy('id', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $muestreos->total(),
                'current_page' => $muestreos->currentPage(),
                'per_page' => $muestreos->perPage(),
                'last_page' => $muestreos->lastPage(),
                'from' => $muestreos->firstItem(),
                'to' => $muestreos->lastPage(),
                'index' => ($muestreos->currentPage()-1)*$muestreos->perPage(),
            ],
            'muestreos' => $muestreos,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:255',
        ]);

        try {
            DB::beginTransaction();
            
            $muestreo = new TipoMuestreo();
            $muestreo->codigo = Str::upper($request->codigo);
            $muestreo->nombre = Str::upper($request->nombre);
            $muestreo->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Tipo de Muestreo se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Tipo de Muestreo, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
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

            $muestreo = TipoMuestreo::findOrFail($request->id);
            $muestreo->codigo = Str::upper($request->codigo);
            $muestreo->nombre = Str::upper($request->nombre);
            $muestreo->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Tipo de Muestreo se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Tipo de Muestreo, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $muestreo = TipoMuestreo::findOrFail($request->id);
            $muestreo->activo = 'N';
            $muestreo->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Tipo de Muestreo se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el Tipo de Muestreo, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
