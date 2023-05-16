<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Aviso;
use App\Models\Config;

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
        return view('index', compact('config', 'aviso'));
    }
}
