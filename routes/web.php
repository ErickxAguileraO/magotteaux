<?php

use App\Http\Controllers\Sistema\ClienteController;
use App\Http\Controllers\Auth\WebController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CargaController;
use App\Http\Controllers\Sistema\CuentaController;
use App\Http\Controllers\Sistema\DestinoController;
use App\Http\Controllers\Sistema\EmpresaTransporteController;
use App\Http\Controllers\Sistema\PaisController;
use App\Http\Controllers\Sistema\PlantaController;
use App\Http\Controllers\Sistema\PuntoCargaController;
use App\Http\Controllers\Sistema\TamanoBolaController;
use App\Http\Controllers\Sistema\TipoCargaController;
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

// Route::get('/', function () {
//     return view('maqueta.home');
// });
// Route::get('login', function () {
//     return view('maqueta.login.index');
// });
Route::get('confimarcion-nueva-contraseña', function () {
    return view('maqueta.login.mensajeNuevaContrasenna');
});

Route::get('confirmacion-recuperar-contraseña', function () {
    return view('maqueta.login.mensajeRecuperarContrasenna');
});

Route::get('correo-detalle', function () {
    return view('maqueta.correos.detalle');
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

// Route::get('clientes', function () {
//     return view('maqueta.clientes.index');
// });
//Route::get('nuevo-cliente', function () {
//  return view('sistema.cliente.crear');
//});

Route::get('destinos', function () {
    return view('maqueta.destinos.index');
});
Route::get('nuevo-destino', function () {
    return view('maqueta.destinos.crear');
});

// Route::get('plantas', function () {
//     return view('maqueta.plantas.index');
// });
// Route::get('nueva-planta', function () {
//     return view('maqueta.plantas.crear');
// });

// Route::get('puntos-de-carga', function () {
//     return view('maqueta.puntosCarga.index');
// });
// Route::get('nuevo-punto-de-carga', function () {
//     return view('maqueta.puntosCarga.crear');
// });

// Route::get('empresa-de-transporte', function () {
//     return view('maqueta.empresaTransporte.index');
// });
// Route::get('nueva-empresa-de-transporte', function () {
//     return view('maqueta.empresaTransporte.crear');
// });

// Route::get('tipos-de-carga', function () {
//     return view('maqueta.tiposCarga.index');
// });
// Route::get('nuevo-tipo-de-carga', function () {
//     return view('maqueta.tiposCarga.crear');
// });

// Route::get('tamaños-de-bola', function () {
//     return view('maqueta.tamañosBola.index');
// });
// Route::get('nuevo-tamaño-de-bola', function () {
//     return view('maqueta.tamañosBola.crear');
// });

// Route::get('paises', function () {
//     return view('maqueta.paises.index');
// });
// Route::get('nuevo-pais', function () {
//     return view('maqueta.paises.crear');
// });

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

// Route::get('editar-perfil', function () {
//     return view('maqueta.perfil.index');
// });

Route::group(['as' => 'web.'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('', [AuthController::class, 'login'])->name('index');
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::group(['as' => 'cuenta.'], function () {
        Route::get('cuenta/edit', [CuentaController::class, 'edit'])->name('edit');
        Route::put('cuenta/update', [CuentaController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'cliente', 'as' => 'cliente.'], function () {
        Route::get('', [ClienteController::class, 'index'])->name('index');
        Route::get('list', [ClienteController::class, 'list'])->name('list');
        Route::get('nuevo-cliente', [ClienteController::class, 'create'])->name('create');
        Route::post('store', [ClienteController::class, 'store'])->name('store');
        Route::get('editar-cliente/{id}', [ClienteController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ClienteController::class, 'update'])->name('update');
        Route::get('delete/{id}', [ClienteController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [ClienteController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'destino', 'as' => 'destino.'], function () {
        Route::get('', [DestinoController::class, 'index'])->name('index');
        Route::get('list', [DestinoController::class, 'list'])->name('list');
        Route::get('nuevo-destino', [DestinoController::class, 'create'])->name('create');
        Route::post('store', [DestinoController::class, 'store'])->name('store');
        Route::get('editar-destino/{id}', [DestinoController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [DestinoController::class, 'update'])->name('update');
        Route::get('delete/{id}', [DestinoController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [DestinoController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'pais', 'as' => 'pais.'], function () {
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
        Route::get('', [PlantaController::class, 'index'])->name('index');
        Route::get('list', [PlantaController::class, 'list'])->name('list');
        Route::get('nuevo-planta', [PlantaController::class, 'create'])->name('create');
        Route::post('store', [PlantaController::class, 'store'])->name('store');
        Route::get('editar-planta/{id}', [PlantaController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [PlantaController::class, 'update'])->name('update');
        Route::get('delete/{id}', [PlantaController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [PlantaController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'punto-carga', 'as' => 'punto.carga.'], function () {
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
        Route::get('', [EmpresaTransporteController::class, 'index'])->name('index');
        Route::get('list', [EmpresaTransporteController::class, 'list'])->name('list');
        Route::get('nuevo-empresa-transporte', [EmpresaTransporteController::class, 'create'])->name('create');
        Route::post('store', [EmpresaTransporteController::class, 'store'])->name('store');
        Route::get('editar-empresa-transporte/{id}', [EmpresaTransporteController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [EmpresaTransporteController::class, 'update'])->name('update');
        Route::get('delete/{id}', [EmpresaTransporteController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [EmpresaTransporteController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'tamano-bola', 'as' => 'tamano.bola.'], function () {
        Route::get('', [TamanoBolaController::class, 'index'])->name('index');
        Route::get('list', [TamanoBolaController::class, 'list'])->name('list');
        Route::get('nuevo-tamano-bola', [TamanoBolaController::class, 'create'])->name('create');
        Route::post('store', [TamanoBolaController::class, 'store'])->name('store');
        Route::get('editar-tamano-bola/{id}', [TamanoBolaController::class, 'edit'])->name('edit')->whereNumber('id');
        Route::post('update/{id}', [TamanoBolaController::class, 'update'])->name('update');
        Route::get('delete/{id}', [TamanoBolaController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [TamanoBolaController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'tipo-carga', 'as' => 'tipo.carga.'], function () {
        Route::get('', [TipoCargaController::class, 'index'])->name('index');
        Route::get('list', [TipoCargaController::class, 'list'])->name('list');
        Route::get('nuevo-tipo-carga', [TipoCargaController::class, 'create'])->name('create');
        Route::post('store', [TipoCargaController::class, 'store'])->name('store');
        Route::get('editar-tipo-carga/{id}', [TipoCargaController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [TipoCargaController::class, 'update'])->name('update');
        Route::get('delete/{id}', [TipoCargaController::class, 'delete'])->name('delete')->whereNumber('id');
        Route::get('download-excel', [TipoCargaController::class, 'downloadExcel'])->name('download.excel');
    });

    Route::group(['prefix' => 'carga', 'as' => 'carga.'], function () {
        Route::get('', [CargaController::class, 'index'])->name('index');
    });
});
