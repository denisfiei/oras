<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Recurso;
use App\Models\CargaGisaid;
use Illuminate\Http\Request;

class SecuenciaController extends Controller
{
    public function index()
    {
        $banner = Recurso::where('activo', 'S')->where('nivel', '9')->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();
        $mapa = Recurso::where('activo', 'S')->where('nivel', '10')->where('pais_id', 5)->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();
        $video = Recurso::where('activo', 'S')->where('nivel', '12')->where('pais_id', 5)->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();
        $temas = Recurso::where('activo', 'S')->where('nivel', '13')->where('pais_id', 5)->orderBy('id', 'DESC')->orderBy('orden', 'ASC')->get();

        $genomas = CargaGisaid::whereHas('carga', function($query) {
            $query->where('activo', 'P');
        })->count();

        $linajes = CargaGisaid::whereHas('carga', function($query) {
            $query->where('activo', 'P');
        })->distinct('lineage')->count();

        return view('sistema.externo.secuenciacion', compact('banner', 'mapa', 'video', 'temas', 'genomas', 'linajes'));
    }

    public function pais($token)
    {
        $pais = Pais::where('token', $token)->first();
        if (!$pais) {
            return redirect("/");
        }
        $banner = Recurso::where('activo', 'S')->where('nivel', '9')->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();
        $mapa = Recurso::where('activo', 'S')->where('nivel', '10')->where('pais_id', $pais->id)->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();
        $instituto = Recurso::where('activo', 'S')->where('nivel', '11')->where('pais_id', $pais->id)->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();
        $video = Recurso::where('activo', 'S')->where('nivel', '12')->where('pais_id', $pais->id)->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();
        $temas = Recurso::where('activo', 'S')->where('nivel', '13')->where('pais_id', $pais->id)->orderBy('id', 'DESC')->orderBy('orden', 'ASC')->get();

        $genomas = CargaGisaid::where('pais_id', $pais->id)->whereHas('carga', function($query) {
            $query->where('activo', 'P');
        })->count();

        $linajes = CargaGisaid::where('pais_id', $pais->id)->whereHas('carga', function($query) {
            $query->where('activo', 'P');
        })->distinct('lineage')->count();

        return view('sistema.externo.secuenciacion_pais', compact('pais', 'banner', 'mapa', 'instituto', 'video', 'temas', 'genomas', 'linajes'));
    }
}
