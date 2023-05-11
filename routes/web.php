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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('paises')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\PaisController::class, 'index'])->name('paises');
        Route::post('/buscar', [App\Http\Controllers\Interno\PaisController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\PaisController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\PaisController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\PaisController::class, 'delete']);
    });

    Route::prefix('menus')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\UserController::class, 'index'])->name('menus');
        Route::post('/buscar', [App\Http\Controllers\Interno\UserController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\UserController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\UserController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\UserController::class, 'delete']);
        Route::post('/alta', [App\Http\Controllers\Interno\UserController::class, 'alta']);
    });
    Route::prefix('roles')->group(function () {
        Route::get('/', [App\Http\Controllers\Interno\UserController::class, 'index'])->name('roles');
        Route::post('/buscar', [App\Http\Controllers\Interno\UserController::class, 'buscar']);
        Route::post('/store', [App\Http\Controllers\Interno\UserController::class, 'store']);
        Route::post('/update', [App\Http\Controllers\Interno\UserController::class, 'update']);
        Route::post('/delete', [App\Http\Controllers\Interno\UserController::class, 'delete']);
        Route::post('/alta', [App\Http\Controllers\Interno\UserController::class, 'alta']);
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
});

