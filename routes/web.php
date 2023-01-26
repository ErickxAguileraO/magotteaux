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
Route::get('nuevo-cliente', function () {
    return view('web.clientes.crear');
});

Route::get('destinos', function () {
    return view('web.destinos.index');
});
Route::get('nuevo-destino', function () {
    return view('web.destinos.crear');
});

Route::get('plantas', function () {
    return view('web.plantas.index');
});
Route::get('nueva-planta', function () {
    return view('web.plantas.crear');
});

Route::get('puntos-de-carga', function () {
    return view('web.puntosCarga.index');
});
Route::get('nuevo-punto-de-carga', function () {
    return view('web.puntosCarga.crear');
});

Route::get('empresa-de-transporte', function () {
    return view('web.empresaTransporte.index');
});
Route::get('nueva-empresa-de-transporte', function () {
    return view('web.empresaTransporte.crear');
});

Route::get('tipos-de-carga', function () {
    return view('web.tiposCarga.index');
});
Route::get('nuevo-tipo-de-carga', function () {
    return view('web.tiposCarga.crear');
});

Route::get('tamaños-de-bola', function () {
    return view('web.tamañosBola.index');
});
Route::get('nuevo-tamaño-de-bola', function () {
    return view('web.tamañosBola.crear');
});

Route::get('paises', function () {
    return view('web.paises.index');
});
Route::get('nuevo-pais', function () {
    return view('web.paises.crear');
});

Route::get('usuarios', function () {
    return view('web.usuarios.index');
});
Route::get('nuevo-usuario', function () {
    return view('web.usuarios.crear');
});

Route::get('patentes', function () {
    return view('web.patentes.index');
});
Route::get('nueva-patente', function () {
    return view('web.patentes.crear');
});

Route::get('choferes', function () {
    return view('web.choferes.index');
});
Route::get('nuevo-chofer', function () {
    return view('web.choferes.crear');
});

Route::get('editar-perfil', function () {
    return view('web.perfil.index');
});