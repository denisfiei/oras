<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Aviso;
use App\Models\Config;
use App\Models\Recurso;

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
        $banners = Recurso::where('activo', 'S')->where('nivel', '1')->orderBy('id', 'DESC')->orderBy('orden', 'ASC')->get();
        $present = Recurso::where('activo', 'S')->where('nivel', '2')->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();

        return view('index', compact('config', 'aviso', 'banners', 'present'));
    }
}
