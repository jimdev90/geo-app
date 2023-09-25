<?php

use App\Http\Controllers\Auth\LoginCustomController;
use App\Http\Controllers\PuntoDelictivoController;
use App\Http\Controllers\PuntoDelictivoImageController;
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
    return view('auth.login');
});

Route::get('/login', [LoginCustomController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginCustomController::class, 'login']);
Route::post('/logout', [LoginCustomController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/punto-delictivo', [PuntoDelictivoController::class, 'index'])->name('punto-delictivo.index');

    Route::get('/punto-delictivo/create', [PuntoDelictivoController::class, 'create'])->name('punto-delictivo.create');
    Route::post('/punto-delictivo/create', [PuntoDelictivoController::class, 'store'])->name('punto-delictivo.store');

    Route::get('/punto-delictivo/{punto}/show', [PuntoDelictivoController::class, 'show'])->name('punto-delictivo.show');

    Route::get('/punto-delictivo/{punto}/edit', [PuntoDelictivoController::class, 'edit'])->name('punto-delictivo.edit');
    Route::put('/punto-delictivo/{punto}', [PuntoDelictivoController::class, 'update'])->name('punto-delictivo.update');

    Route::get('/punto-delictivo/{punto}/edit-images', [PuntoDelictivoController::class, 'editImages'])->name('punto-delictivo.edit-images');
    Route::post('/punto-delictivo/store-images', [PuntoDelictivoImageController::class, 'store'])->name('punto-delictivo.store-images');
    Route::delete('/punto-delictivo/{imagen}/delete-images', [PuntoDelictivoImageController::class, 'delete'])->name('punto-delictivo.delete-images');


    Route::delete('/punto-delictivo/{punto}', [PuntoDelictivoController::class, 'delete'])->name('punto-delictivo.delete');
});


