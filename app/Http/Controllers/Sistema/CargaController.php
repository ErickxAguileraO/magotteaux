<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CargaController extends Controller
{
    public function sendEmail ()
    {
        return view('sistema.auth.recuperarContrasenna');
    }
}
