<?php

use App\Http\Controllers\Sistema\ClienteController;
use App\Http\Controllers\Auth\WebController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CargaController;
use App\Http\Controllers\sistema\CuentaController;
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
    return view('maqueta.home');
});
Route::get('login', function () {
    return view('maqueta.login.index');
});
Route::get('confimarcion-nueva-contraseña', function () {
    return view('maqueta.login.mensajeNuevaContrasenna');
});

Route::get('confirmacion-recuperar-contraseña', function () {
    return view('maqueta.login.mensajeRecuperarContrasenna');
});

Route::get('nueva-contraseña', function () {
    return view('maqueta.login.nuevaContrasenna');
});

Route::get('recuperar-contraseña', function () {
    return view('maqueta.login.recuperarContrasenna');
});

Route::get('nueva-carga', function () {
    return view('maqueta.ingresarCarga.index');
});
Route::get('detalle-carga', function () {
    return view('maqueta.ingresarCarga.detalle');
});

Route::get('clientes', function () {
    return view('maqueta.clientes.index');
});
Route::get('nuevo-cliente', function () {
    return view('maqueta.clientes.crear');
});

Route::get('destinos', function () {
    return view('maqueta.destinos.index');
});
Route::get('nuevo-destino', function () {
    return view('maqueta.destinos.crear');
});

Route::get('plantas', function () {
    return view('maqueta.plantas.index');
});
Route::get('nueva-planta', function () {
    return view('maqueta.plantas.crear');
});

Route::get('puntos-de-carga', function () {
    return view('maqueta.puntosCarga.index');
});
Route::get('nuevo-punto-de-carga', function () {
    return view('maqueta.puntosCarga.crear');
});

Route::get('empresa-de-transporte', function () {
    return view('maqueta.empresaTransporte.index');
});
Route::get('nueva-empresa-de-transporte', function () {
    return view('maqueta.empresaTransporte.crear');
});

Route::get('tipos-de-carga', function () {
    return view('maqueta.tiposCarga.index');
});
Route::get('nuevo-tipo-de-carga', function () {
    return view('maqueta.tiposCarga.crear');
});

Route::get('tamaños-de-bola', function () {
    return view('maqueta.tamañosBola.index');
});
Route::get('nuevo-tamaño-de-bola', function () {
    return view('maqueta.tamañosBola.crear');
});

Route::get('paises', function () {
    return view('maqueta.paises.index');
});
Route::get('nuevo-pais', function () {
    return view('maqueta.paises.crear');
});

Route::get('usuarios', function () {
    return view('maqueta.usuarios.index');
});
Route::get('nuevo-usuario', function () {
    return view('maqueta.usuarios.crear');
});

Route::get('patentes', function () {
    return view('maqueta.patentes.index');
});
Route::get('nueva-patente', function () {
    return view('maqueta.patentes.crear');
});

Route::get('choferes', function () {
    return view('maqueta.choferes.index');
});
Route::get('nuevo-chofer', function () {
    return view('maqueta.choferes.crear');
});

Route::get('editar-perfil', function () {
    return view('maqueta.perfil.index');
});

Route::group(['middleware' => ['guest'], 'as' => 'web.'], function () {
    Route::get('', [AuthController::class, 'login'])->name('index');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::group(['as' => 'cuenta.'], function () {
    Route::get('cuenta/edit', [CuentaController::class, 'edit'])->name('edit');
    Route::put('cuenta/update', [CuentaController::class, 'update'])->name('update');
});

Route::group(['prefix' => 'cliente', 'as' => 'cliente.'], function () {
    Route::get('', [ClienteController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'carga', 'as' => 'carga.'], function () {
    Route::get('', [CargaController::class, 'index'])->name('index');
});
