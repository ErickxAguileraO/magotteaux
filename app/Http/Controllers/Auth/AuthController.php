<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('sistema.auth.login');
    }

    public function authenticate(AuthenticateRequest $request)
    {
        $isValid = Auth::attempt([
            'usu_email' => $request->post('email'),
            'password' => $request->post('password')
        ]);

        if (!$isValid) return redirect()->back()->with(['message' => 'Correo o contraseña incorrecto', 'type' => 'error'])->withInput();

        if (auth()->user()->hasRole('Admin')) return redirect()->route('cliente.index');
        if (auth()->user()->hasRole('Cliente')) return redirect()->route('carga.index');
        if (auth()->user()->hasRole('Logistica')) return redirect()->route('carga.index');
    }
}
