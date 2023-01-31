<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\cuenta\CreateTipoCargaRequest;
use App\Models\TipoCarga;
use Illuminate\Http\Request;

class TipoCargaController extends Controller
{
    public function index()
    {
        return view('sistema.tiposCarga.index');
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
            return redirect()->back()->with(['message' => 'error de ingreso', 'type' => 'error']);
        }
    }
}
