<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\InicioController::class, 'index']);

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('paises')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\PaisController::class, 'index'])->name('paises');
        Route::post('/buscar', [App\Http\Controllers\Interno\PaisController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\PaisController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\PaisController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\PaisController::class, 'delete']);
    });

    Route::prefix('laboratorios')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\LaboratorioController::class, 'index'])->name('laboratorios');
        Route::post('/datos', [App\Http\Controllers\Interno\LaboratorioController::class, 'datos']);
        Route::post('/buscar', [App\Http\Controllers\Interno\LaboratorioController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\LaboratorioController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\LaboratorioController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\LaboratorioController::class, 'delete']);
    });

    Route::prefix('centros')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\CentroController::class, 'index'])->name('centros');
        Route::post('/buscar', [App\Http\Controllers\Interno\CentroController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\CentroController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\CentroController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\CentroController::class, 'delete']);
    });

    Route::prefix('muestreos')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\MuestreoController::class, 'index'])->name('muestreos');
        Route::post('/buscar', [App\Http\Controllers\Interno\MuestreoController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\MuestreoController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\MuestreoController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\MuestreoController::class, 'delete']);
    });
    
    Route::prefix('recursos')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\RecursoController::class, 'index'])->name('recursos');
        Route::post('/datos', [App\Http\Controllers\Interno\RecursoController::class, 'datos']);
        Route::post('/buscar', [App\Http\Controllers\Interno\RecursoController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\RecursoController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\RecursoController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\RecursoController::class, 'delete']);
    });
    
    Route::prefix('voi_voc')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\VoiVocController::class, 'index'])->name('voi_voc');
        Route::post('/datos', [App\Http\Controllers\Interno\VoiVocController::class, 'datos']);
        Route::post('/buscar', [App\Http\Controllers\Interno\VoiVocController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\VoiVocController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\VoiVocController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\VoiVocController::class, 'delete']);
    });

    Route::prefix('virus')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\VirusController::class, 'index'])->name('virus');
        Route::post('/buscar', [App\Http\Controllers\Interno\VirusController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\VirusController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\VirusController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\VirusController::class, 'delete']);
    });

    Route::prefix('linajes')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\LinajeController::class, 'index'])->name('linajes');
        Route::post('/buscar', [App\Http\Controllers\Interno\LinajeController::class, 'buscar']);
        Route::post('/delete', [App\Http\Controllers\Interno\LinajeController::class, 'delete']);
        Route::post('/carga', [App\Http\Controllers\Interno\LinajeController::class, 'carga']);
        Route::post('/rows', [App\Http\Controllers\Interno\LinajeController::class, 'rows']);
        Route::post('/import', [App\Http\Controllers\Interno\LinajeController::class, 'import']);
    });
    
    Route::prefix('cargas')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\CargaController::class, 'index'])->name('cargas');
        Route::post('/datos', [App\Http\Controllers\Interno\CargaController::class, 'datos']);
        Route::post('/buscar', [App\Http\Controllers\Interno\CargaController::class, 'buscar']);
        Route::post('/publicado', [App\Http\Controllers\Interno\CargaController::class, 'publicado']);
        Route::post('/delete', [App\Http\Controllers\Interno\CargaController::class, 'delete']);
        Route::post('/delete_detalle', [App\Http\Controllers\Interno\CargaController::class, 'delete_detalle']);
        Route::post('/datos_gisaid', [App\Http\Controllers\Interno\CargaController::class, 'datos_gisaid']);
        Route::post('/datos_detalle', [App\Http\Controllers\Interno\CargaController::class, 'datos_detalle']);
        
        Route::post('/rows', [App\Http\Controllers\Interno\CargaController::class, 'rows']);
        Route::post('/gisaid', [App\Http\Controllers\Interno\CargaController::class, 'gisaid']);
        Route::post('/detalle', [App\Http\Controllers\Interno\CargaController::class, 'detalle']);
    });

    Route::prefix('menus')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\MenuController::class, 'index'])->name('menus');
        Route::post('/buscar', [App\Http\Controllers\Interno\MenuController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\MenuController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\MenuController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\MenuController::class, 'delete']);
    });
    Route::prefix('roles')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\RolController::class, 'index'])->name('roles');
        Route::post('/datos', [App\Http\Controllers\Interno\RolController::class, 'datos']);
        Route::post('/buscar', [App\Http\Controllers\Interno\RolController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\RolController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\RolController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\RolController::class, 'delete']);
        Route::get('/permisos/{id}', [App\Http\Controllers\Interno\RolController::class, 'permisos']);
    });
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\UserController::class, 'index'])->name('users');
        Route::post('/datos', [App\Http\Controllers\Interno\UserController::class, 'datos']);
        Route::post('/buscar', [App\Http\Controllers\Interno\UserController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\UserController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\UserController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\UserController::class, 'delete']);
        Route::post('/alta', [App\Http\Controllers\Interno\UserController::class, 'alta']);
    });

    Route::prefix('config')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\ConfigController::class, 'index'])->name('config');
        Route::post('/buscar', [App\Http\Controllers\Interno\ConfigController::class, 'buscar']);
        Route::post('/update', [App\Http\Controllers\Interno\ConfigController::class, 'update']);
    });
    
    Route::prefix('avisos')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\AvisoController::class, 'index'])->name('avisos');
        Route::post('/buscar', [App\Http\Controllers\Interno\AvisoController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\AvisoController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\AvisoController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\AvisoController::class, 'delete']);
    });
    
    Route::prefix('logs')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\ConfigController::class, 'index'])->name('logs');
        Route::post('/buscar', [App\Http\Controllers\Interno\ConfigController::class, 'buscar']);
        Route::post('/update', [App\Http\Controllers\Interno\ConfigController::class, 'update']);
    });
});

Route::prefix('vigilancia')->group(function () {
    Route::get('/', [App\Http\Controllers\VigilanciaController::class, 'index'])->name('vigilancia');
});

Route::prefix('red_regional')->group(function () {
    Route::get('/', [App\Http\Controllers\RedRegionalController::class, 'index'])->name('red_regional');
});

Route::prefix('secuenciacion')->group(function () {
    Route::get('/', [App\Http\Controllers\SecuenciaController::class, 'index'])->name('secuenciacion');
    Route::get('/{token}', [App\Http\Controllers\SecuenciaController::class, 'pais']);
});

Route::prefix('distribucion')->group(function () {
    Route::get('/', [App\Http\Controllers\VigilanciaController::class, 'index'])->name('distribucion');
});

Route::prefix('centro_informacion')->group(function () {
    Route::get('/tipo/{tipo}', [App\Http\Controllers\CentroInformacionController::class, 'index'])->name('centro_informacion');
    Route::get('/tipo/{tipo}/{anio}', [App\Http\Controllers\CentroInformacionController::class, 'anio']);

    Route::get('/download/{id}', [App\Http\Controllers\CentroInformacionController::class, 'download']);
});