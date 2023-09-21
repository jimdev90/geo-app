<?php

use App\Http\Controllers\PuntoDelictivoController;
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

Auth::routes([
    "register" => false,
    "reset" => false,
    "confirm" => false,
    "verify" => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/punto-delictivo/create', [PuntoDelictivoController::class, 'create'])->name('punto-delictivo.create');
Route::post('/punto-delictivo/create', [PuntoDelictivoController::class, 'store'])->name('punto-delictivo.store');
Route::get('/punto-delictivo/{punto}', [PuntoDelictivoController::class, 'edit'])->name('punto-delictivo.edit');
Route::put('/punto-delictivo/{punto}', [PuntoDelictivoController::class, 'update'])->name('punto-delictivo.update');
Route::delete('/punto-delictivo/{punto}', [PuntoDelictivoController::class, 'delete'])->name('punto-delictivo.delete');
