<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\PuntoCargaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\PuntoCarga\CreatePuntoCargaRequest;
use App\Http\Requests\PuntoCarga\UpdatePuntoCargaRequest;
use App\Http\Resources\PuntoCargaResource;
use App\Models\Planta;
use App\Models\PuntoCarga;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PuntoCargaController extends Controller
{
    public function index()
    {
        return view('sistema.puntosCarga.index');
    }

    public function list()
    {
        return PuntoCargaResource::collection(PuntoCarga::all());
    }

    public function create()
    {
        $puntoCarga = PuntoCarga::all();
        $planta = Planta::all();
        return view('sistema.puntosCarga.crear', compact('puntoCarga', 'planta'));
    }

    public function store(CreatePuntoCargaRequest $request)
    {
        try {
            $puntoCarga = new PuntoCarga();
            $puntoCarga->puc_nombre = ucwords(strtolower($request->nombre_puntoCarga));
            $puntoCarga->puc_estado = $request->slc_estado_puntoCarga;
            $puntoCarga->puc_planta_id = $request->slc_planta_puntoCarga;
            $puntoCarga->save();
            return redirect()->route('punto.carga.index')->with(['message' => 'Se creo un nuevo punto de carga', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear un punto de carga', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $puntoCarga = PuntoCarga::findOrFail($id);
        $planta = Planta::all();
        return view('sistema.puntosCarga.editar', compact('puntoCarga', 'planta'));
    }

    public function update(UpdatePuntoCargaRequest $request, int $id)
    {
        try {
            $puntoCarga = PuntoCarga::findOrFail($id);
            $puntoCarga->puc_nombre = ucwords(strtolower($request->nombre_puntoCarga));
            $puntoCarga->puc_estado = $request->slc_estado_puntoCarga;
            $puntoCarga->puc_planta_id = $request->slc_planta_puntoCarga;
            $puntoCarga->save();
            return redirect()->route('punto.carga.index')->with(['message' => 'Se creo un nuevo punto de carga', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar un punto de carga', 'type' => 'error']);
        }
    }
    public function delete(int $id)
    {
        try {
            PuntoCarga::findOrFail($id)->delete();

            return redirect()->route('punto.carga.index')->with(['message' => 'Punto de carga eliminado correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar el punto de carga', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $puntoCarga = PuntoCarga::all();

            return Excel::download(new PuntoCargaExport($puntoCarga), 'Puntodecarga.xlsx');

         } catch (\Throwable $th) {

             return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
         }
    }
}
