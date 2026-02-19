<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EquipController;
use App\Http\Controllers\Api\EstadiController;
use App\Http\Controllers\Api\PartitController;
use App\Http\Controllers\Api\JugadoraController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('equips', [EquipController::class, 'index']);
Route::get('equips/{equip}', [EquipController::class, 'show']);

Route::get('estadis', [EstadiController::class, 'index']);
Route::get('estadis/{estadi}', [EstadiController::class, 'show']);

Route::get('partits', [PartitController::class, 'index']);
Route::get('partits/{partit}', [PartitController::class, 'show']);

Route::get('jugadores', [JugadoraController::class, 'index']);
Route::get('jugadores/{jugadora}', [JugadoraController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    Route::apiResource('equips', EquipController::class)->except(['index', 'show']);
    Route::apiResource('estadis', EstadiController::class)->except(['index', 'show']);
    Route::apiResource('partits', PartitController::class)->except(['index', 'show']);
    Route::apiResource('jugadores', JugadoraController::class)->except(['index', 'show']);
});