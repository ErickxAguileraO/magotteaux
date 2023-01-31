<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\cuenta\CreatePlantaRequest;
use App\Http\Requests\cuenta\UpdatePlantaRequest;
use App\Models\Pais;
use App\Models\Planta;
use Illuminate\Http\Request;

class PlantaController extends Controller
{
    public function index()
    {
        return view('sistema.plantas.index');
    }

    public function create()
    {
        $planta = Planta::all();
        $paises = Pais::all();
        return view('sistema.plantas.crear', compact('paises', 'planta'));
    }

    public function store(CreatePlantaRequest $request)
    {
        try {
            $planta = new Planta();
            $planta->pla_nombre = ucwords(strtolower($request->nombre_planta));
            $planta->pla_estado = $request->estado_planta;
            $planta->pla_pais_id = $request->slc_planta_pais;
            $planta->save();
            return redirect()->route('planta.index')->with(['message' => 'Se creo una nueva planta', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $planta = Planta::findOrFail($id);
        $paises = Pais::all();
        return view('sistema.plantas.editar', compact('planta','paises'));
    }

    public function update(UpdatePlantaRequest $request,int $id)
    {
        //dd($request->all());
        try {
            $planta = Planta::findOrFail($id);
            $planta->pla_nombre = ucwords(strtolower($request->nombre_planta));
            $planta->pla_estado = $request->estado_planta;
            $planta->pla_pais_id = $request->slc_planta_pais;
            $planta->save();
            return redirect()->route('planta.index')->with(['message' => 'Se edito correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
        }
    }
}
