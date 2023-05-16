<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Virus;

class VirusController extends Controller
{
    public function index()
    {
        return view('sistema.interno.virus.inicio');
    }

    public function buscar(Request $request)
    {
        $virus = Virus::where('activo', 'S');

        if ($request->search) {
            $search = $request->search;
            
            $virus->where(function ($query) use ($search){
                $query->where('nombre', 'LIKE', "%{$search}%")
                ->orWhere('codigo', 'LIKE', "%{$search}%");
            });
        }

        $virus = $virus->orderBy('nombre', 'ASC')->paginate(10);

        return [
            'pagination' => [
                'total' => $virus->total(),
                'current_page' => $virus->currentPage(),
                'per_page' => $virus->perPage(),
                'last_page' => $virus->lastPage(),
                'from' => $virus->firstItem(),
                'to' => $virus->lastPage(),
                'index' => ($virus->currentPage()-1)*$virus->perPage(),
            ],
            'virus' => $virus,
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|max:20',
            'nombre' => 'required|max:100',
        ]);

        try {
            DB::beginTransaction();
            
            $virus = new Virus();
            $virus->codigo = Str::upper($request->codigo);
            $virus->nombre = Str::upper($request->nombre);
            $virus->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Virus se registró con éxito.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al crear el Virus, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'codigo' => 'required|max:20',
            'nombre' => 'required|max:100',
        ]);

        try {

            DB::beginTransaction();

            $virus = Virus::findOrFail($request->id);
            $virus->codigo = Str::upper($request->codigo);
            $virus->nombre = Str::upper($request->nombre);
            $virus->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Virus se actualizó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al actualizar el Virus, intente nuevamente o contacte al Administrador del Sistema. Código de error '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }

    public function delete(Request $request)
    {
        try {

            DB::beginTransaction();

            $virus = Virus::findOrFail($request->id);
            $virus->activo = 'N';
            $virus->save();

            DB::commit();

            return [
                'action'    =>  'success',
                'title'     =>  'Bien!!',
                'message'   =>  'El Virus se eliminó con éxito.',
            ];


        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'action'    =>  'error',
                'title'     =>  'Incorrecto!!',
                'message'   =>  'Ocurrio un error al Eliminar el Virus, intente nuevamente o contacte al Administrador del Sistema. Código de error: '.$e->getMessage(),
                'error'     =>  'Error: '.$e->getMessage()
            ];
        }
    }
}
