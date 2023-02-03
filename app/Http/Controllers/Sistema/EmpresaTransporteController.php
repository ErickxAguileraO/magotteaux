<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\EmpresaTransporteExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaTransporte\CreateEmpresaTransporteRequest;
use App\Http\Requests\EmpresaTransporte\UpdateEmpresaTransporteRequest;
use App\Http\Resources\EmpresaTransporteResource;
use App\Models\EmpresaTransporte;
use CreateEmpresaTransportesTable;
use Illuminate\Http\Request;
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
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
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
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {
            EmpresaTransporte::findOrFail($id)->delete();

            return redirect()->route('empresa.transporte.index')->with(['message' => 'Empresa  de transporte eliminado correctamente', 'type' => 'success']);
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
