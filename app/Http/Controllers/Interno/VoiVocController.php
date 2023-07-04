<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\VoiVoc;
use App\Models\Menu;
use App\Models\Permiso;

class VoiVocController extends Controller
{
    public function index()
    {
        $menu = Menu::where('route', Route::currentRouteName())->pluck('id')->first();

        if (Permiso::where('rol_id', Auth::user()->rol_id)->where('menu_id', $menu)->first()) {
            return view('sistema.interno.voivoc.inicio');
        }

        return redirect('home');
    }

    public function buscar(Request $request)
    {
        $voivoc = VoiVoc::where('activo', 'S');

        if ($request->search) {
            $search = $request->search;
            
            $voivoc->where(function ($query) use ($search){
                $query->where('codigo', 'LIKE', "%{$search}%");
            });
        }

        $voivoc = $voivoc->orderBy('id', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $voivoc->total(),
                'current_page' => $voivoc->currentPage(),
                'per_page' => $voivoc->perPage(),
                'last_page' => $voivoc->lastPage(),
                'from' => $voivoc->firstItem(),
                'to' => $voivoc->lastPage(),
                'index' => ($voivoc->currentPage()-1)*$voivoc->perPage(),
            ],
            'voivoc' => $voivoc,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|max:20',
            'tipo' => 'required|min:3|max:3',
        ]);

        try {
            DB::beginTransaction();
            
            $voivoc = new VoiVoc();
            $voivoc->codigo = Str::upper($request->codigo);
            $voivoc->tipo = Str::upper($request->tipo);
            $voivoc->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El VoiVoc se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el VoiVoc, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|max:20',
            'tipo' => 'required|min:3|max:3',
        ]);

        try {

            DB::beginTransaction();

            $voivoc = VoiVoc::findOrFail($request->id);
            $voivoc->codigo = Str::upper($request->codigo);
            $voivoc->tipo = Str::upper($request->tipo);
            $voivoc->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El VoiVoc se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el VoiVoc, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $voivoc = VoiVoc::findOrFail($request->id);
            $voivoc->activo = 'N';
            $voivoc->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El VoiVoc se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el VoiVoc, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
