<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso;

class RedRegionalController extends Controller
{
    public function index()
    {
        $banner = Recurso::where('activo', 'S')->where('nivel', '6')->orderBy('orden', 'DESC')->first();
        $intro = Recurso::where('activo', 'S')->where('nivel', '7')->orderBy('orden', 'DESC')->first();

        return view('sistema.externo.red', compact('banner', 'intro'));
    }
}
