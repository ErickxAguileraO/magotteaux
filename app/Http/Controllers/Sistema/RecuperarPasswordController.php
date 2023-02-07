<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateRecuperarPasswordRequest;
use App\Mail\RestaurarPassword\PasswordRestaurada;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Spatie\Permission\Contracts\Role;

class RecuperarPasswordController extends Controller
{
    public function create()
    {
        return view('sistema.auth.recuperarContrasenna');
    }
    public function store(CreateRecuperarPasswordRequest $request)
    {
        $usuario = User::where('usu_email', $request->email_recuperar)->first();

        if (!$usuario) {
            return redirect()->back()->with(['message' => 'Correo ingresado no es valido', 'type' => 'error']);
        }

        $password_nueva = Str::random(10);
        Mail::to($usuario->usu_email)->send((new PasswordRestaurada($usuario, $password_nueva)));

        $usuario->update(['usu_password' => $password_nueva]);
        return redirect()->route('web.login')->with(['message' => 'Se envió a su correo la nueva contraseña', 'type' => 'success']);
    }
}
