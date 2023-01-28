<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\cuenta\CreateClienteRequest;
use App\Models\Cliente;
use App\Models\Pais;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return view('sistema.cliente.index');
    }


    public function create()
    {
        $paises = Pais::all();
        return view('sistema.cliente.crear', compact('paises'));
    }
    public function store(CreateClienteRequest $request)
    {

        //dd($request->all(),Cliente::all()->first);
         $cliente = new Cliente();
         $cliente->cli_nombre = $request->crear_nombre_cliente;
         $cliente->cli_identificacion = $request->identificador_cliente;
         $cliente->cli_pais_id = $request->slc_crear_pais_cliente;
         $cliente->cli_estado = $request->slc_estado_cliente;
         $cliente->save();
        //$datosCliente = Cliente::create($request->all());
        //Cliente::create($request->all());
        return redirect()->route('cliente.index');
    }
}
