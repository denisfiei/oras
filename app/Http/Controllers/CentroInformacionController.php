<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CentroInformacionController extends Controller
{
    public function index()
    {
        return view('sistema.externo.centro_informacion');
    }
}
