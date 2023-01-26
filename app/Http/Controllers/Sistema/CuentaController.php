<?php

namespace App\Http\Controllers\sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function edit()
    {   
        return view('sistema.perfil.edit');
    }
}
