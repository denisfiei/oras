<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso;

class VigilanciaController extends Controller
{
    public function index()
    {
        $banner = Recurso::where('activo', 'S')->where('nivel', '4')->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();
        $intro = Recurso::where('activo', 'S')->where('nivel', '5')->orderBy('id', 'DESC')->orderBy('orden', 'DESC')->first();

        return view('sistema.externo.vigilancia', compact('banner', 'intro'));
    }
}
