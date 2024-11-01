<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitasController;
use App\Http\Controllers\InfoController;

/*
|--------------------------------------------------------------------------
| API Routes 
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/  

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/new-visita', [VisitasController::class, 'insert']); 

Route::get('/get-user/{documento?}', [InfoController::class, 'getUser']); 
Route::get('/get-user-puntos/{id?}', [InfoController::class, 'getUserPuntos']);
Route::get('/get-pdv/{num_pdv?}/{user_id?}', [InfoController::class, 'getPdv']);  
Route::get('/get-pdv-mobil/{num_pdv?}/{user_id?}', [InfoController::class, 'getPdvMobil']);  
Route::get('/get-premios-by-marca/{marca_id?}', [InfoController::class, 'getPremiosByMarca']);
Route::post('/redimir-premio/{user_id?}/{premio_id?}/{direccion?}/{fecha_entrega?}', [InfoController::class, 'redimirPremio']);
Route::post('/registrar-visita', [InfoController::class, 'registrarVisita']);
Route::post('/registrar-visita-mobil', [InfoController::class, 'registrarVisitaMobil']);
Route::get('/get-premio-pdv/{num_visita?}', [InfoController::class, 'getPremioByNumVisita']);
Route::get('/get-premio/{user_id?}/{premio_id?}', [InfoController::class, 'getPremios']);
