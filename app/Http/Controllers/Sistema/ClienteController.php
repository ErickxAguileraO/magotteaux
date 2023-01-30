<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::withFilters()->get();

        return view('sistema.cliente.index', compact('clientes'));
    }
}
