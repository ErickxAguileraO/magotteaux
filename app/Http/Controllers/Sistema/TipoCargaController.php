<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\TipoCargaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoCarga\CreateTipoCargaRequest;
use App\Http\Requests\TipoCarga\UpdateTipoCargaRequest;
use App\Http\Resources\TipoCargaResource;
use App\Models\TipoCarga;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TipoCargaController extends Controller
{
    public function index()
    {
        return view('sistema.tiposCarga.index');
    }

    public function list()
    {
        return TipoCargaResource::collection(TipoCarga::all());
    }

    public function create()
    {
        $tipoCarga = TipoCarga::all();
        return view('sistema.tiposCarga.crear', compact('tipoCarga'));
    }

    public function store(CreateTipoCargaRequest $request)
    {
        try {
            $tipoCarga = new TipoCarga();
            $tipoCarga->tic_nombre = ucwords(strtolower($request->nombre_tipo_carga));
            $tipoCarga->tic_estado = $request->slc_estado_tipo_carga;
            $tipoCarga->save();
            return redirect()->route('tipo.carga.index')->with(['message' => 'Se creo un nuevo tipo de carga', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear un tipo de carga', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $tipoCarga = TipoCarga::findOrFail($id);
        return view('sistema.tiposCarga.editar', compact('tipoCarga'));
    }

    public function update(UpdateTipoCargaRequest $request, int $id)
    {
        try {
            $tipoCarga = TipoCarga::findOrFail($id);
            $tipoCarga->tic_nombre = ucwords(strtolower($request->nombre_tipo_carga));
            $tipoCarga->tic_estado = $request->slc_estado_tipo_carga;
            $tipoCarga->save();
            return redirect()->route('tipo.carga.index')->with(['message' => 'Se edito un tipo carga', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar un tipo de carga', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {
            TipoCarga::findOrFail($id)->delete();

            return redirect()->route('tipo.carga.index')->with(['message' => 'Tipo de carga eliminado correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar el tipo de carga', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $tipoCarga = TipoCarga::all();

            return Excel::download(new TipoCargaExport($tipoCarga), 'TipoDeCarga.xlsx');

         } catch (\Throwable $th) {

             return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
         }
    }
}
