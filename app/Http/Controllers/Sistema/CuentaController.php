<?php

namespace App\Http\Controllers\sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function edit()
    {
        dump(session()->all());
        session()->flash('success', 'Registro actualizado con éxito.');

        return view('sistema.perfil.edit');
    }
}
