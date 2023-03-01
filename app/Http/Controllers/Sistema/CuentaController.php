<?php

namespace App\Http\Controllers\sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\cuenta\UpdateCuentaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

class CuentaController extends Controller
{
    public function edit()
    {

        return view('sistema.perfil.edit');
    }

    public function update(UpdateCuentaRequest $request)
    {
        $usuario = Auth::user();
        $comprobar = Hash::check($request->password_actual, $usuario->usu_password);
        if (!$comprobar) {
            return redirect()->back()->with(['message' => 'La contraseña actual es incorrecta', 'type' => 'error']);
        }

        $usuario->update(['usu_password' => $request->password_nueva]);


        if ($usuario->roles()->first()->name == 'Admin') {
            return redirect()->route('cliente.index')->with(['message' => 'Contraseña actualizada correctamente', 'type' => 'success']);
        }else {
            return redirect()->route('carga.index')->with(['message' => 'Contraseña actualizada correctamente', 'type' => 'success']);
        }

    }
}
