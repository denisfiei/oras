<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Aviso;
use App\Models\CargaGisaid;
use App\Models\Config;
use App\Models\Recurso;
use App\Models\VoiVoc;
use App\Models\ViewVoiVoc;

class InicioController extends Controller
{
    public function index(Request $request)
    {
        if( !Cache::has('config_cache') ) {
            $c_cache = Config::first();
            Cache::forever('config_cache', $c_cache);
        }
        $config = Cache::get('config_cache');
        $aviso = Aviso::where('mostrar', 'S')->first();
        $banners = Recurso::where('activo', 'S')->where('nivel', '1')->orderBy('orden', 'ASC')->get();
        $present = Recurso::where('activo', 'S')->where('nivel', '2')->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();
        $casos = CargaGisaid::whereHas('carga', function($query) {
            $query->where('activo', 'P');
        });

        $peru = clone $casos;//1
        $colombia = clone $casos;//2
        $bolivia = clone $casos;//3
        $ecuador = clone $casos;//4
        
        $casos = $casos->count();
        $peru = $peru->where('pais_id', 1)->count();
        $colombia = $colombia->where('pais_id', 2)->count();
        $bolivia = $bolivia->where('pais_id', 3)->count();
        $ecuador = $ecuador->where('pais_id', 4)->count();

        $voi = VoiVoc::where('tipo', 'VOI')
        ->withCount('voi_voc_casos')
        ->get();
        $voc = VoiVoc::where('tipo', 'VOC')
        ->withCount('voi_voc_casos')
        ->get();
        //return $voi;

        /*->withCount([
            'voi_voc_casos as count' => function($q) {
                $q->where('nivel1', 'Peru');
            }
        ])*/
        
        return view('index', compact('config', 'aviso', 'banners', 'present', 'casos', 'peru', 'colombia', 'bolivia', 'ecuador', 'voi', 'voc'));
    }
}
