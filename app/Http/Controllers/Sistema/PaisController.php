<?php

namespace App\Http\Controllers\Sistema;

use App\Exports\PaisExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pais\CreatePaisRequest;
use App\Http\Requests\Pais\UpdatePaisRequest;
use App\Http\Resources\PaisResource;
use App\Models\Cliente;
use App\Models\Pais;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaisController extends Controller
{
    public function index()
    {
        return view('sistema.paises.index');
    }

    public function list()
    {
        return PaisResource::collection(Pais::all());
    }

    public function create()
    {
        $paises = Pais::all();
        return view('sistema.paises.crear', compact('paises'));
    }

    public function store(CreatePaisRequest $request)
    {
        try {
            $pais = new Pais();
            $pais->pai_nombre = ucwords(strtolower($request->pais_nombre));
            $pais->pai_estado = $request->slc_estado_pais;
            $pais->save();
            return redirect()->route('pais.index')->with(['message' => 'Se creo un nuevo pais', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar crear un país', 'type' => 'error']);
        }
    }

    public function edit($id)
    {
        $paises = Pais::findOrFail($id);
        return view('sistema.paises.editar', compact('paises'));
    }

    public function update(UpdatePaisRequest $request, int $id)
    {

        try {
            $pais = Pais::findOrFail($id);
            $pais->pai_nombre = ucwords(strtolower($request->pais_nombre));
            $pais->pai_estado = $request->slc_estado_pais;
            $pais->save();
            return redirect()->route('pais.index')->with(['message' => 'Se edito el pais con exito', 'type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar editar un país', 'type' => 'error']);
        }
    }

    public function delete(int $id)
    {
        try {
            Pais::findOrFail($id)->delete();

            return redirect()->route('pais.index')->with(['message' => 'País eliminado correctamente', 'type' => 'success']);
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar eliminar el país', 'type' => 'error']);
        }
    }

    public function downloadExcel()
    {
        try {
            $pais = Pais::all();

            return Excel::download(new PaisExport($pais), 'Paises.xlsx');
        } catch (\Throwable $th) {

            return redirect()->back()->with(['message' => 'Ocurrio un error al intentar descargar el excel', 'type' => 'error']);
        }
    }
}
