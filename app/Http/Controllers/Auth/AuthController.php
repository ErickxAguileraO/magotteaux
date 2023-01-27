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

        //redireccionar a dashboard dependiendo de su rol

        // dd(auth()->user());
        // if(auth()->user())

        return redirect()->route('web.index');
    }
}
