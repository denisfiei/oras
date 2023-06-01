<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;

class SecuenciaController extends Controller
{
    public function index()
    {
        $video = Recurso::where('activo', 'S')->where('nivel', '10')->orderBy('orden', 'DESC')->first();
        $temas = Recurso::where('activo', 'S')->where('nivel', '11')->orderBy('orden', 'ASC')->get();

        return view('sistema.externo.secuenciacion', compact('video', 'temas'));
    }
}
