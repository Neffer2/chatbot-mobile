<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PuntosVentaController;
use Illuminate\Support\Facades\Hash;

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

Route::get('/', [HomeController::class, 'index'])->middleware('auth'); 
Route::get('visitas', function (){
    return view('agente.visitas'); 
});

Route::middleware('auth')->group(function () {
    Route::get('/metas', [HomeController::class, 'metas'])->name('metas');
    Route::get('/ranking', [HomeController::class, 'ranking'])->name('ranking');
    Route::get('/premios', [HomeController::class, 'premios'])->name('premios');
    Route::get('/catalogos', [HomeController::class, 'catalogos'])->name('catalogos');
    Route::get('/ventas-aprobar', [HomeController::class, 'visitas'])->name('visitas');
    Route::get('/ventas-aprobar-mobil', [HomeController::class, 'visitasMobil'])->name('visitas-mobil');
    //Historico de registros
    Route::get('/historico-registros', [HomeController::class, 'historicoRegistros'])->name('historico-registros');
    Route::get('/historico-ventas', [HomeController::class, 'historicoVentas'])->name('historico-ventas');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/terminos-condiciones', function () {
    return view('terminos-condiciones');
})->middleware(['auth', 'verified'])->name('terminos-condiciones');

Route::get('/puntos-venta', [PuntosVentaController::class, 'index'])->name('puntos-venta');

require __DIR__.'/auth.php';
