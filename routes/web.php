<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('web.home');
});
Route::get('login', function () {
    return view('web.login.index');
});
Route::get('confimarcion-nueva-contraseña', function () {
    return view('web.login.mensajeNuevaContrasenna');
});

Route::get('confirmacion-recuperar-contraseña', function () {
    return view('web.login.mensajeRecuperarContrasenna');
});

Route::get('nueva-contraseña', function () {
    return view('web.login.nuevaContrasenna');
});

Route::get('recuperar-contraseña', function () {
    return view('web.login.recuperarContrasenna');
});

Route::get('nueva-carga', function () {
    return view('web.ingresarCarga.index');
});
Route::get('detalle-carga', function () {
    return view('web.ingresarCarga.detalle');
});

Route::get('clientes', function () {
    return view('web.clientes.index');
});
Route::get('crear-cliente', function () {
    return view('web.clientes.crearCliente');
});

