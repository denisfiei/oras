<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Linaje;

class LinajeController extends Controller
{
    public function index()
    {
        return view('sistema.interno.linajes.inicio');
    }

    public function buscar(Request $request)
    {
        $linajes = Linaje::where('activo', 'S');

        if ($request->search) {
            $search = $request->search;
            
            $linajes->where(function ($query) use ($search){
                $query->where('nombre', 'LIKE', "%{$search}%");
            });
        }

        $linajes = $linajes->orderBy('nombre', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $linajes->total(),
                'current_page' => $linajes->currentPage(),
                'per_page' => $linajes->perPage(),
                'last_page' => $linajes->lastPage(),
                'from' => $linajes->firstItem(),
                'to' => $linajes->lastPage(),
                'index' => ($linajes->currentPage()-1)*$linajes->perPage(),
            ],
            'linajes' => $linajes,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|max:20',
            'nombre' => 'max:50',
            'clade' => 'max:50',
        ]);

        try {
            DB::beginTransaction();
            
            $linaje = new Linaje();
            $linaje->codigo = Str::upper($request->codigo);
            $linaje->nombre = Str::upper($request->nombre);
            $linaje->clade = $request->clade;
            $linaje->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Linaje se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Linaje, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|max:20',
            'nombre' => 'max:50',
            'clade' => 'max:50'
        ]);

        try {

            DB::beginTransaction();

            $linaje = Linaje::findOrFail($request->id);
            $linaje->codigo = Str::upper($request->codigo);
            $linaje->nombre = Str::upper($request->nombre);
            $linaje->clade = $request->clade;
            $linaje->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Linaje se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Linaje, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $linaje = Linaje::findOrFail($request->id);
            $linaje->activo = 'N';
            $linaje->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Linaje se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el Linaje, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
