<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeputadoController;
use App\Http\Controllers\GastoDeputadoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/deputados');
});

Route::get('/deputados', [DeputadoController::class, 'index'])->name('deputados.index');
Route::get('/deputados/{id}/despesas', [GastoDeputadoController::class, 'index'])->name('despesas.index');
Route::post('/deputados/sincronizar', [DeputadoController::class, 'sincronizar'])->name('deputados.sincronizar');
Route::delete('/deputados/limpar', [DeputadoController::class, 'limpar'])->name('deputados.limpar');
Route::get('/sincronismo', [\App\Http\Controllers\SincronismoController::class, 'index'])->name('sincronismo.index');

