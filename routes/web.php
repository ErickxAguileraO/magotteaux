<?php

use App\Http\Controllers\Sistema\ClienteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Sistema\ArchivoController;
use App\Http\Controllers\Sistema\CargaController;
use App\Http\Controllers\Sistema\ChoferController;
use App\Http\Controllers\Sistema\CuentaController;
use App\Http\Controllers\Sistema\DestinoController;
use App\Http\Controllers\Sistema\EmpresaTransporteController;
use App\Http\Controllers\Sistema\PaisController;
use App\Http\Controllers\Sistema\PatenteController;
use App\Http\Controllers\Sistema\PlantaController;
use App\Http\Controllers\Sistema\PuntoCargaController;
use App\Http\Controllers\Sistema\RecuperarPasswordController;
use App\Http\Controllers\Sistema\TamanoBolaController;
use App\Http\Controllers\Sistema\TipoCargaController;
use App\Http\Controllers\Sistema\UsuarioController;
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

Route::group(['as' => 'web.'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('', [AuthController::class, 'login'])->name('index');
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['as' => 'recupera.password.'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('recuperar-contrasenna', [RecuperarPasswordController::class, 'create'])->name('create');
        Route::post('store', [RecuperarPasswordController::class, 'store'])->name('store');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'cuenta', 'as' => 'cuenta.'], function () {
        Route::get('edit', [CuentaController::class, 'edit'])->name('edit');
        Route::put('update', [CuentaController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'cliente', 'as' => 'cliente.'], function () {
        Route::get('{id}/destino', [ClienteController::class, 'listDestinos'])->name('list.destino');
        Route::middleware(['role:Admin'])->group(function () {
            Route::get('', [ClienteController::class, 'index'])->name('index');
            Route::get('list', [ClienteController::class, 'list'])->name('list');
            Route::get('nuevo-cliente', [ClienteController::class, 'create'])->name('create');
            Route::post('store', [ClienteController::class, 'store'])->name('store');
            Route::get('editar-cliente/{id}', [ClienteController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ClienteController::class, 'update'])->name('update');
            Route::get('delete/{id}', [ClienteController::class, 'delete'])->name('delete')->whereNumber('id');
            Route::get('download-excel', [ClienteController::class, 'downloadExcel'])->name('download.excel');
        });
    });

    Route::group(['prefix' => 'destino', 'as' => 'destino.', 'middleware' => ['role:Admin']], function () {
        Route::get('', [DestinoController::class, 'index'])->name('index');
        Route::get('list', [DestinoController::class, 'list'])->name('list');
        Route::get('nuevo-destino', [DestinoController::class, 'create'])->name('create');
        Route::post('store', [DestinoController::class, 'store'])->name('store');
        Route::get('editar-destino/{id}', [DestinoController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [DestinoController::class, 'update'])->name('update');
        Route::get('delete/{id}', [DestinoController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [DestinoController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'pais', 'as' => 'pais.', 'middleware' => ['role:Admin']], function () {
        Route::get('', [PaisController::class, 'index'])->name('index');
        Route::get('list', [PaisController::class, 'list'])->name('list');
        Route::get('nuevo-pais', [PaisController::class, 'create'])->name('create');
        Route::post('store', [PaisController::class, 'store'])->name('store');
        Route::get('editar-pais/{id}', [PaisController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PaisController::class, 'update'])->name('update');
        Route::get('delete/{id}', [PaisController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [PaisController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'planta', 'as' => 'planta.'], function () {
        Route::get('{id}/punto-carga', [PlantaController::class, 'listPuntoCargas'])->name('list.punto.carga');
        Route::middleware(['role:Admin'])->group(function () {
            Route::get('', [PlantaController::class, 'index'])->name('index');
            Route::get('list', [PlantaController::class, 'list'])->name('list');
            Route::get('nuevo-planta', [PlantaController::class, 'create'])->name('create');
            Route::post('store', [PlantaController::class, 'store'])->name('store');
            Route::get('editar-planta/{id}', [PlantaController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [PlantaController::class, 'update'])->name('update');
            Route::get('delete/{id}', [PlantaController::class, 'delete'])->name('delete')->whereNumber('id');
            Route::get('download-excel', [PlantaController::class, 'downloadExcel'])->name('download.excel');
        });
    });

    Route::group(['prefix' => 'punto-carga', 'as' => 'punto.carga.', 'middleware' => ['role:Admin']], function () {
        Route::get('', [PuntoCargaController::class, 'index'])->name('index');
        Route::get('list', [PuntoCargaController::class, 'list'])->name('list');
        Route::get('nuevo-punto-carga', [PuntoCargaController::class, 'create'])->name('create');
        Route::post('store', [PuntoCargaController::class, 'store'])->name('store');
        Route::get('editar-punto-carga/{id}', [PuntoCargaController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PuntoCargaController::class, 'update'])->name('update');
        Route::get('delete/{id}', [PuntoCargaController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [PuntoCargaController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'empresa-transporte', 'as' => 'empresa.transporte.'], function () {
        Route::get('{id}/chofer', [EmpresaTransporteController::class, 'listChoferes'])->name('list.choferes');
        Route::get('{id}/patente', [EmpresaTransporteController::class, 'listPatentes'])->name('list.patentes');
        Route::middleware(['role:Admin'])->group(function () {
            Route::get('', [EmpresaTransporteController::class, 'index'])->name('index');
            Route::get('list', [EmpresaTransporteController::class, 'list'])->name('list');
            Route::get('nuevo-empresa-transporte', [EmpresaTransporteController::class, 'create'])->name('create');
            Route::post('store', [EmpresaTransporteController::class, 'store'])->name('store');
            Route::get('editar-empresa-transporte/{id}', [EmpresaTransporteController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [EmpresaTransporteController::class, 'update'])->name('update');
            Route::get('delete/{id}', [EmpresaTransporteController::class, 'delete'])->name('delete')->whereNumber('id');
            Route::get('download-excel', [EmpresaTransporteController::class, 'downloadExcel'])->name('download.excel');
        });
    });

    Route::group(['prefix' => 'tamano-bola', 'as' => 'tamano.bola.', 'middleware' => ['role:Admin']], function () {
        Route::get('', [TamanoBolaController::class, 'index'])->name('index');
        Route::get('list', [TamanoBolaController::class, 'list'])->name('list');
        Route::get('nuevo-tamano-bola', [TamanoBolaController::class, 'create'])->name('create');
        Route::post('store', [TamanoBolaController::class, 'store'])->name('store');
        Route::get('editar-tamano-bola/{id}', [TamanoBolaController::class, 'edit'])->name('edit')->whereNumber('id');
        Route::post('update/{id}', [TamanoBolaController::class, 'update'])->name('update')->whereNumber('id');
        Route::get('delete/{id}', [TamanoBolaController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [TamanoBolaController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'usuario', 'as' => 'usuario.', 'middleware' => ['role:Admin']], function () {
        Route::get('', [UsuarioController::class, 'index'])->name('index');
        Route::get('list', [UsuarioController::class, 'list'])->name('list');
        Route::get('nuevo-usuario', [UsuarioController::class, 'create'])->name('create');
        Route::post('store', [UsuarioController::class, 'store'])->name('store');
        Route::get('editar-usuario/{id}', [UsuarioController::class, 'edit'])->name('edit')->whereNumber('id');
        Route::post('update/{id}', [UsuarioController::class, 'update'])->name('update')->whereNumber('id');
        Route::get('delete/{id}', [UsuarioController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [UsuarioController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'chofer', 'as' => 'chofer.', 'middleware' => ['role:Admin']], function () {
        Route::get('', [ChoferController::class, 'index'])->name('index');
        Route::get('list', [ChoferController::class, 'list'])->name('list');
        Route::get('nuevo-chofer', [ChoferController::class, 'create'])->name('create');
        Route::post('store', [ChoferController::class, 'store'])->name('store');
        Route::get('editar-chofer/{id}', [ChoferController::class, 'edit'])->name('edit')->whereNumber('id');
        Route::post('update/{id}', [ChoferController::class, 'update'])->name('update')->whereNumber('id');
        Route::get('delete/{id}', [ChoferController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [ChoferController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'tipo-carga', 'as' => 'tipo.carga.', 'middleware' => ['role:Admin']], function () {
        Route::get('', [TipoCargaController::class, 'index'])->name('index');
        Route::get('list', [TipoCargaController::class, 'list'])->name('list');
        Route::get('nuevo-tipo-carga', [TipoCargaController::class, 'create'])->name('create');
        Route::post('store', [TipoCargaController::class, 'store'])->name('store');
        Route::get('editar-tipo-carga/{id}', [TipoCargaController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [TipoCargaController::class, 'update'])->name('update');
        Route::get('delete/{id}', [TipoCargaController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [TipoCargaController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'carga', 'as' => 'carga.', 'middleware' => ['role:Logistica|Cliente']], function () {
        Route::get('', [CargaController::class, 'index'])->name('index');
        Route::get('list', [CargaController::class, 'list'])->name('list');

        Route::middleware(['role:Logistica'])->group(function () {
            Route::get('nueva-carga', [CargaController::class, 'create'])->name('create');
            Route::post('store', [CargaController::class, 'store'])->name('store');
            Route::get('editar-carga/{id}', [CargaController::class, 'edit'])->name('edit')->whereNumber('id');
            Route::post('update/{id}', [CargaController::class, 'update'])->name('update')->whereNumber('id');
            Route::get('{id}/correo', [CargaController::class, 'sendEmail'])->name('send.email');
            Route::get('delete/{id}', [CargaController::class, 'delete'])->name('delete')->whereNumber('id');

        });
        Route::get('show/{id}', [CargaController::class, 'show'])->name('show');
        Route::get('download-excel', [CargaController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'patente', 'as' => 'patente.'], function () {
        Route::get('', [PatenteController::class, 'index'])->name('index');
        Route::get('list', [PatenteController::class, 'list'])->name('list');
        Route::get('nueva-patente', [PatenteController::class, 'create'])->name('create');
        Route::post('store', [PatenteController::class, 'store'])->name('store');
        Route::get('editar-patente/{id}', [PatenteController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PatenteController::class, 'update'])->name('update');
        Route::get('delete/{id}', [PatenteController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [PatenteController::class, 'downloadExcel'])->name('download.excel');
    });


});
Route::get('download-file/{url}', [ArchivoController::class, 'downloadFile'])->name('download.file');
Route::get('detalle-carga-correo/{id}/{token}', [CargaController::class, 'cargaDetail'])->name('detalle.carga.correo');





// Otras rutas
Route::get('/notificaciones', function () {
    return view('sistema.notificaciones.index');
});

Route::get('/crear-notificacion', function () {
    return view('sistema.notificaciones.crear');
});