<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\ClientesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\CreateClienteRequest;
use App\Http\Requests\Cliente\UpdateClienteRequest;
use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use App\Models\Pais;
use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    public function index()
    {
        return view('sistema.cliente.index');
    }

    public function list()
    {
        return ClienteResource::collection(Cliente::withFilters()->get());
    }

    public function create()
    {
        $paises = Pais::all();
        return view('sistema.cliente.crear', compact('paises'));
    }

    public function store(CreateClienteRequest $request)
    {
        try {
            $cliente = new Cliente();
            $cliente->cli_nombre = $request->crear_nombre_cliente;
            $cliente->cli_identificacion = $request->identificador_cliente;
            $cliente->cli_pais_id = $request->slc_crear_pais_cliente;
            $cliente->cli_estado = $request->slc_estado_cliente;
            $cliente->save();
            return redirect()->route('cliente.index')->with(['message' => 'Se creo un nuevo cliente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        $paises = Pais::all();
        return view('sistema.cliente.editar', compact('cliente', 'paises'));
    }

    public function update(UpdateClienteRequest $request, int $id)
    {

        //try {
            $cliente = Cliente::findOrFail($id);
            $cliente->cli_nombre = $request->editar_nombre_cliente;
            $cliente->cli_identificacion = $request->identificador_cliente;
            $cliente->cli_pais_id = $request->slc_crear_pais_cliente;
            $cliente->cli_estado = $request->slc_estado_cliente;
            $cliente->save();
            return redirect()->route('cliente.index')->with(['message' => 'Se edito correctamente', 'type' => 'success']);
        //} catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
        //}
    }

    public function delete(int $id)
    {
        try {
            Cliente::findOrFail($id)->delete();

            return redirect()->route('cliente.index')->with(['message' => 'Cliente eliminado correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar el cliente', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $clientes = Cliente::all();

            return Excel::download(new ClientesExport($clientes), 'clientes.xlsx');

        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        }
    }
}
