<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\cuenta\CreatePuntoCargaRequest;
use App\Http\Requests\cuenta\UpdatePuntoCargaRequest;
use App\Models\Planta;
use App\Models\PuntoCarga;
use Illuminate\Http\Request;

class PuntoCargaController extends Controller
{
    public function index()
    {
        return view('sistema.puntosCarga.index');
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
            return redirect()->route('puntoCarga.index')->with(['message' => 'Se creo un nuevo punto de carga', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $puntoCarga = PuntoCarga::findOrFail($id);
        $planta = Planta::all();
        return view('sistema.puntosCarga.editar', compact('puntoCarga','planta'));
    }

    public function update(UpdatePuntoCargaRequest $request, int $id)
    {
        try {
            $puntoCarga = PuntoCarga::findOrFail($id);
            $puntoCarga->puc_nombre = ucwords(strtolower($request->nombre_puntoCarga));
            $puntoCarga->puc_estado = $request->slc_estado_puntoCarga;
            $puntoCarga->puc_planta_id = $request->slc_planta_puntoCarga;
            $puntoCarga->save();
            return redirect()->route('puntoCarga.index')->with(['message' => 'Se creo un nuevo punto de carga', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
        }
    }
}
