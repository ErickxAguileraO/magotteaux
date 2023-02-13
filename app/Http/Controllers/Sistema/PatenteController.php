<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\PatenteExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Patente\CreatePatenteRequest;
use App\Http\Requests\Patente\UpdatePatenteRequest;
use App\Http\Resources\PatenteResource;
use App\Models\EmpresaTransporte;
use App\Models\Patente;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PatenteController extends Controller
{
    public function index()
    {
        return view('sistema.patentes.index');
    }

    public function list()
    {
        return PatenteResource::collection(Patente::all());
    }

    public function create()
    {
        $patentes = Patente::all();
        $empresaTransporte = EmpresaTransporte::all();
        return view('sistema.patentes.crear', compact('patentes','empresaTransporte'));
    }

    public function store(CreatePatenteRequest $request)
    {
         try {
            $patente = new Patente();
            $patente->pat_patente = $request->numero_patente;
            $patente->pat_estado = $request->estado_patente;
            $patente->pat_empresa_id = $request->empresa_transporte_patente;
            $patente->save();
            return redirect()->route('patente.index')->with(['message' => 'Se creo una nueva patente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear una patente', 'type' => 'error']);
        }
    }
    public function edit($id)
    {
        $patentes = Patente::findOrFail($id);
        $empresaTransporte = EmpresaTransporte::all();
        return   view('sistema.patentes.editar', compact('patentes','empresaTransporte'));
    }

    public function update(UpdatePatenteRequest $request, int $id)
    {

        try {
            $patente = Patente::findOrFail($id);
            $patente->pat_patente = $request->numero_patente;
            $patente->pat_estado = $request->estado_patente;
            $patente->pat_empresa_id = $request->empresa_transporte_patente;
            $patente->save();
            return redirect()->route('patente.index')->with(['message' => 'Se editó una patente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar una patente', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {
            $patente = Patente::withExists('cargas')->findOrFail($id);

            if($patente->cargas_exists) return redirect()->route('patente.index')->with(['message' => 'No se puede eliminar porque tiene información relacionada', 'type' => 'error']);
            $patente->delete();
            return redirect()->route('patente.index')->with(['message' => 'Patente eliminado correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar un destino', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $patente = Patente::all();

            return Excel::download(new PatenteExport($patente), 'Patentes.xlsx');
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        }
    }
}
