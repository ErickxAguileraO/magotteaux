<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;

class ClienteController extends Controller
{
    public function index()
    {
        return view('sistema.cliente.index');
    }
}
