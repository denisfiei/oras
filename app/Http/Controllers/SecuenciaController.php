<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecuenciaController extends Controller
{
    public function index()
    {
        return view('sistema.externo.secuenciacion');
    }
}