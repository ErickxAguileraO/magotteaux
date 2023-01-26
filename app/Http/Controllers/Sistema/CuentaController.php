<?php

namespace App\Http\Controllers\sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\cuenta\UpdateCuentaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function edit()
    {
        //dump(session()->all());
       // $password = User::find($id);
        session()->flash('success', 'Registro actualizado con éxito.');



        return view('sistema.perfil.edit');
    }

    public function update(UpdateCuentaRequest $request)
    {

        return redirect()->route('cliente.index')
            ->with('success', 'Registro actualizado con éxito');
    }
}
