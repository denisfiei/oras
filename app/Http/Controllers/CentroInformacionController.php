<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Centro;
use App\Models\Recurso;

class CentroInformacionController extends Controller
{
    public function index($tipo)
    {
        $banner = Recurso::where('activo', 'S')->where('nivel', '4')->orderBy('orden', 'DESC')->first();
        
        switch ($tipo) {
            case 'DT':
                $centro = Centro::findOrFail(1);
                break;
            case 'PU':
                $centro = Centro::findOrFail(2);
                break;
            case 'WF':
                $centro = Centro::findOrFail(3);
                break;
            case 'SP':
                $centro = Centro::findOrFail(4);
                break;
            default:
                $centro = Centro::where('id', '>', 4)->first();
                break;
        }
        $anio = date('Y');
        $anios = [$anio, $anio-1, 1];
        return view('sistema.externo.centro_informacion', compact('banner', 'tipo', 'centro', 'anios'));
    }

    public function anio($tipo, $anio)
    {
        if (is_numeric($anio)) {
            $banner = Recurso::where('activo', 'S')->where('nivel', '4')->orderBy('orden', 'DESC')->first();

            switch ($tipo) {
                case 'DT':
                    $centro = Centro::findOrFail(1);
                    break;
                case 'PU':
                    $centro = Centro::findOrFail(2);
                    break;
                case 'WF':
                    $centro = Centro::findOrFail(3);
                    break;
                case 'SP':
                    $centro = Centro::findOrFail(4);
                    break;
                default:
                    $centro = Centro::where('id', '>', 4)->first();
                    break;
            }

            $recursos = Recurso::where('nivel', '20')
            ->where('centro_id', $centro->id)
            ->where('activo', 'S');

            if ($anio == 1) {
                $anio_menor = date('Y')-2;
                $recursos->whereYear('fecha', '<=', $anio_menor);
                $anio_text = 'Anteriores a '.date('Y');
            } else {
                $recursos->whereYear('fecha', $anio);
                $anio_text = $anio;
            }
            
            $recursos = $recursos->with('pais')->orderBy('fecha', 'DESC')->get();
    
            return view('sistema.externo.recursos', compact('banner', 'tipo', 'centro', 'recursos', 'anio_text'));
        }

        return redirect()->back();
    }

    public function download($id)
    {
        $recurso = Recurso::findOrFail($id);

        return Storage::download("public/recursos/{$recurso->imagen}", $recurso->nombre_archivo);
    }
}
