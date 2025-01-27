<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\EmpresaTransporteExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaTransporte\CreateEmpresaTransporteRequest;
use App\Http\Requests\EmpresaTransporte\UpdateEmpresaTransporteRequest;
use App\Http\Resources\ChoferByEmpresaTransporteResource;
use App\Http\Resources\EmpresaTransporteResource;
use App\Http\Resources\PatenteByEmpresaTransporteResource;
use App\Models\Chofer;
use App\Models\EmpresaTransporte;
use App\Models\Patente;
use Maatwebsite\Excel\Facades\Excel;

class EmpresaTransporteController extends Controller
{
    public function index()
    {
        return view('sistema.empresaTransporte.index');
    }

    public function list()
    {
        return EmpresaTransporteResource::collection(EmpresaTransporte::all());
    }

    public function listChoferes(int $id)
    {
        $choferes = Chofer::active()->where('cho_empresa_id', $id)->get();

        return ChoferByEmpresaTransporteResource::collection($choferes);
    }

    public function listPatentes(int $id)
    {
        $patentes = Patente::active()->where('pat_empresa_id', $id)->get();

        return PatenteByEmpresaTransporteResource::collection($patentes);
    }

    public function create()
    {
        $empresaTransporte = EmpresaTransporte::all();
        return view('sistema.empresaTransporte.crear', compact('empresaTransporte'));
    }

    public function store(CreateEmpresaTransporteRequest $request)
    {
        try {
            $empresaTransporte = new EmpresaTransporte();
            $empresaTransporte->emt_nombre = ucwords(strtolower($request->nombre_empresa));
            $empresaTransporte->emt_identificacion = $request->rut_empresa;
            $empresaTransporte->emt_estado = $request->slc_estado_empresa;
            $empresaTransporte->save();
            return redirect()->route('empresa.transporte.index')->with(['message' => 'Se creo una nueva empresa', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear una empresa de transporte', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $empresaTransporte = EmpresaTransporte::findOrFail($id);
        return   view('sistema.empresaTransporte.editar', compact('empresaTransporte'));
    }

    public function update(UpdateEmpresaTransporteRequest $request, int $id)
    {

        try {
            $empresaTransporte = EmpresaTransporte::findOrFail($id);
            $empresaTransporte->emt_nombre = ucwords(strtolower($request->nombre_empresa));
            $empresaTransporte->emt_identificacion = $request->rut_empresa;
            $empresaTransporte->emt_estado = $request->slc_estado_empresa;
            $empresaTransporte->save();
            return redirect()->route('empresa.transporte.index')->with(['message' => 'Se edito una empresa con exito', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar una Empresa de transporte', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {

            $empresaTransporte = EmpresaTransporte::withExists('cargas')->findOrFail($id);
            $patente = EmpresaTransporte::withExists('patentes')->findOrFail($id);
            $chofer = EmpresaTransporte::withExists('choferes')->findOrFail($id);

            if($empresaTransporte->cargas_exists) return redirect()->route('empresa.transporte.index')->with(['message' => 'No se puede eliminar porque tiene información relacionada', 'type' => 'error']);
            if($patente->patentes_exists) return redirect()->route('empresa.transporte.index')->with(['message' => 'No se puede eliminar porque tiene información relacionada', 'type' => 'error']);
            if($chofer->choferes_exists) return redirect()->route('empresa.transporte.index')->with(['message' => 'No se puede eliminar porque tiene información relacionada', 'type' => 'error']);
            $empresaTransporte->delete();
            return redirect()->route('empresa.transporte.index')->with(['message' => 'Empresa transporte eliminado correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar una empresa de transporte', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $empresaTransporte = EmpresaTransporte::all();

            return Excel::download(new EmpresaTransporteExport($empresaTransporte), 'EmpresaTransporte.xlsx');
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        }
    }
}
