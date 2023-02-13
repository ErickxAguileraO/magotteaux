<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\DestinoExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Destino\CreateDestinoRequest;
use App\Http\Requests\Destino\UpdateDestinoRequest;
use App\Http\Resources\DestinoResource;
use App\Models\Cliente;
use App\Models\Destino;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DestinoController extends Controller
{
    public function index()
    {
        return view('sistema.destinos.index');
    }

    public function list()
    {
        return DestinoResource::collection(Destino::all());
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('sistema.destinos.crear', compact('clientes'));
    }

    public function store(CreateDestinoRequest $request)
    {
        try {
            $destino = new Destino();
            $destino->des_nombre = $request->nombre_destino;
            $destino->des_estado = $request->estado_destino;
            $destino->des_cliente_id = $request->cliente_destino;
            $destino->save();
            return redirect()->route('destino.index')->with(['message' => 'Se creo un nuevo destino', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear un destino', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $destino = Destino::findOrFail($id);
        $clientes = Cliente::all();
        return   view('sistema.destinos.editar', compact('destino','clientes'));
    }

    public function update(UpdateDestinoRequest $request, int $id)
    {

        try {
            $destino = Destino::findOrFail($id);
            $destino->des_nombre = $request->nombre_destino;
            $destino->des_estado = $request->estado_destino;
            $destino->des_cliente_id = $request->cliente_destino;
            $destino->save();
            return redirect()->route('destino.index')->with(['message' => 'Se edito el destino con exito', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar un destino', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {
            $destino = Destino::withExists('cargas')->findOrFail($id);

            if($destino->cargas_exists) return redirect()->route('destino.index')->with(['message' => 'No se puede eliminar porque tiene información relacionada', 'type' => 'error']);

            $destino->delete();
            return redirect()->route('destino.index')->with(['message' => 'Destino eliminado correctamente', 'type' => 'success']);

        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar un destino', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        //try {
            $destino = Destino::all();

            return Excel::download(new DestinoExport($destino), 'Destinos.xlsx');
        // } catch (\Throwable $th) {

        //     return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        // }
    }

}
