<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VigilanciaController extends Controller
{
    public function index()
    {
        return view('sistema.externo.vigilancia');
    }
}
