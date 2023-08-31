<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Aviso;
use App\Models\CargaGisaid;
use App\Models\Centro;
use App\Models\Config;
use App\Models\Recurso;
use App\Models\VoiVoc;

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
        
        $casos_fecha = $casos->orderBy('collection_date', 'DESC')->pluck('collection_date')->first();
        $casos = $casos->count();
        $peru_fecha = $peru->where('pais_id', 1)->orderBy('collection_date', 'DESC')->pluck('collection_date')->first();
        $peru = $peru->where('pais_id', 1)->count();
        $colombia_fecha = $colombia->where('pais_id', 2)->orderBy('collection_date', 'DESC')->pluck('collection_date')->first();
        $colombia = $colombia->where('pais_id', 2)->count();
        $bolivia_fecha = $bolivia->where('pais_id', 3)->orderBy('collection_date', 'DESC')->pluck('collection_date')->first();
        $bolivia = $bolivia->where('pais_id', 3)->count();
        $ecuador_fecha = $ecuador->where('pais_id', 4)->orderBy('collection_date', 'DESC')->pluck('collection_date')->first();
        $ecuador = $ecuador->where('pais_id', 4)->count();

        $centros = Centro::where('activo', 'S')->orderBy('id', 'ASC')->get();

        $voi = VoiVoc::where('tipo', 'VOI')
        ->where('activo', 'S')
        ->withCount('voi_voc_peru')
        ->withCount('voi_voc_colombia')
        ->withCount('voi_voc_ecuador')
        ->withCount('voi_voc_bolivia')
        ->get();
        $voc = VoiVoc::where('tipo', 'VOC')
        ->where('activo', 'S')
        ->withCount('voi_voc_peru')
        ->withCount('voi_voc_colombia')
        ->withCount('voi_voc_ecuador')
        ->withCount('voi_voc_bolivia')
        ->get();
        $vbm = VoiVoc::where('tipo', 'VBM')
        ->where('activo', 'S')
        ->withCount('voi_voc_peru')
        ->withCount('voi_voc_colombia')
        ->withCount('voi_voc_ecuador')
        ->withCount('voi_voc_bolivia')
        ->get();
        
        return view('index', compact('config', 'aviso', 'banners', 'present', 'casos_fecha', 'casos', 'peru_fecha', 'peru', 'colombia_fecha', 'colombia', 'bolivia_fecha', 'bolivia', 'ecuador_fecha', 'ecuador', 'centros', 'voi', 'voc', 'vbm'));
    }
}
