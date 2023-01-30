<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\cuenta\CreateClienteRequest;
use App\Http\Requests\cuenta\CreatePaisRequest;
use App\Http\Requests\cuenta\UpdatePaisRequest;
use App\Models\Cliente;
use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function index()
    {
        return view('sistema.paises.index');
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
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
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
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
        }
    }
}
