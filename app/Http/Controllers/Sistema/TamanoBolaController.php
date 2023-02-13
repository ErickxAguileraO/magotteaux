<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\TamanoDeBolasExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\TamnoBola\CreateTamanoBolaRequest;
use App\Http\Requests\TamnoBola\UpdateTamanoBolaRequest;
use App\Http\Resources\TamanoBolaResource;
use App\Models\TamanoBola;
use Maatwebsite\Excel\Facades\Excel;

class TamanoBolaController extends Controller
{
    public function index()
    {
        return view('sistema.tamanoBola.index');
    }

    public function list()
    {
        return TamanoBolaResource::collection(TamanoBola::all());
    }

    public function create()
    {
        return view('sistema.tamanoBola.crear');
    }

    public function store(CreateTamanoBolaRequest $request)
    {
        try {

            TamanoBola::create([
                'tab_tamano' => $request->post('tamano'),
                'tab_estado' => $request->post('estado'),
            ]);

            return redirect()->route('tamano.bola.index')->with(['message' => 'Se creo un nuevo tamaño de bola', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear el tamaño de bola', 'type' => 'error']);
        }
    }

    public function edit(int $id)
    {
        $tamano = TamanoBola::findOrFail($id);

        return view('sistema.tamanoBola.editar', compact('tamano'));
    }

    public function update(UpdateTamanoBolaRequest $request, int $id)
    {
        try {

            $tamano = TamanoBola::findOrFail($id);

            $tamano->update([
                'tab_tamano' => $request->post('tamano'),
                'tab_estado' => $request->post('estado'),
            ]);

            return redirect()->route('tamano.bola.index')->with(['message' => 'Se edito el tamaño de bola', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar el tamaño de bola', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {
            $tamanoBola = TamanoBola::withExists('cargas')->findOrFail($id);

            if($tamanoBola->cargas_exists) return redirect()->route('tamano.bola.index')->with(['message' => 'No se puede eliminar porque tiene información relacionada', 'type' => 'error']);
            $tamanoBola->delete();
            return redirect()->route('tamano.bola.index')->with(['message' => 'Tamaño de bola eliminado correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar el tamaño de bola', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $tamanos = TamanoBola::all();

            return Excel::download(new TamanoDeBolasExport($tamanos), 'tamaños-de-bola.xlsx');
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        }
    }
}
