<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('sistema.auth.login');
    }

    public function authenticate(AuthenticateRequest $request)
    {

        $usuario = User::where('usu_email', $request->post('email'))->first();
        $isValidPassword = Hash::check($request->post('password'), $usuario->usu_password);

        if ($usuario && !$isValidPassword) return redirect()->back()->with(['message' => 'Contraseña incorrecta', 'type' => 'error'])->withInput();
        if (!$usuario->usu_estado) return redirect()->back()->with(['message' => 'La cuenta esta inactiva, por favor comuniquese con el administrador.', 'type' => 'error'])->withInput();

        Auth::login($usuario);

        if (auth()->user()->hasRole('Admin')) return redirect()->route('cliente.index');
        if (auth()->user()->hasRole('Cliente')) return redirect()->route('carga.index');
        if (auth()->user()->hasRole('Logistica')) return redirect()->route('carga.index');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('web.login');
    }
}
