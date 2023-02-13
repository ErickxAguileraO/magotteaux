<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\PlantaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Planta\CreatePlantaRequest;
use App\Http\Requests\Planta\UpdatePlantaRequest;
use App\Http\Resources\PuntoCargaByPlantaResource;
use App\Http\Resources\PlantaResource;
use App\Models\Pais;
use App\Models\Planta;
use App\Models\PuntoCarga;
use Maatwebsite\Excel\Facades\Excel;

class PlantaController extends Controller
{
    public function index()
    {
        return view('sistema.plantas.index');
    }

    public function listPuntoCargas(int $id)
    {
        $punto_cargas = PuntoCarga::active()->where('puc_planta_id', $id)->get();

        return PuntoCargaByPlantaResource::collection($punto_cargas);
    }

    public function list()
    {
        return PlantaResource::collection(Planta::all());
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
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear una planta', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $planta = Planta::findOrFail($id);
        $paises = Pais::all();
        return view('sistema.plantas.editar', compact('planta', 'paises'));
    }

    public function update(UpdatePlantaRequest $request, int $id)
    {
        try {
            $planta = Planta::findOrFail($id);
            $planta->pla_nombre = ucwords(strtolower($request->nombre_planta));
            $planta->pla_estado = $request->estado_planta;
            $planta->pla_pais_id = $request->slc_planta_pais;
            $planta->save();
            return redirect()->route('planta.index')->with(['message' => 'Se edito correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar una planta', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {
            $planta = Planta::withExists('cargas')->findOrFail($id);

            if($planta->cargas_exists) return redirect()->route('planta.index')->with(['message' => 'No se puede eliminar porque tiene información relacionada', 'type' => 'error']);
            $planta->delete();
            return redirect()->route('planta.index')->with(['message' => 'Planta eliminado correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar la planta', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $planta = Planta::all();

            return Excel::download(new PlantaExport($planta), 'planta.xlsx');
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        }
    }
}
