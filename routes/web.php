<?php

use App\Http\Controllers\PartitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;



// --- RUTA INICI (HOME) ---
// Li afegim el nom 'home' per solucionar l'error del menú
Route::get('/', function () {
    return view('welcome'); 
})->name('home');


// --- RUTES EQUIPS ---
// Apuntem al teu EquipsController i li afegim el nom 'equips.index'
Route::prefix('equips')->name('equips.')->group(function () {
    Route::get('/', [EquipController::class, 'index'])->name('index');
    Route::get('/crear', [EquipController::class, 'create'])->name('create');
    Route::post('/', [EquipController::class, 'store'])->name('store');
});

// --- FASE 1: RUTES ESTADIS ---
// Aquestes ja tenien nom gràcies al ->name('estadis.')
Route::prefix('estadis')->name('estadis.')->group(function () {
    Route::get('/', [EstadiController::class, 'index'])->name('index');
    Route::get('/crear', [EstadiController::class, 'create'])->name('create');
    Route::post('/', [EstadiController::class, 'store'])->name('store');
});

Route::prefix('jugadores')->name('jugadores.')->group(function () {
    Route::get('/', [JugadoraController::class, 'index'])->name('index');
    Route::get('/crear', [JugadoraController::class, 'create'])->name('create');
    Route::post('/', [JugadoraController::class, 'store'])->name('store');
});

Route::prefix('partits')->name('partits.')->group(function () {
    Route::get('/', [PartitController::class, 'index'])->name('index');
    Route::get('/crear', [PartitController::class, 'create'])->name('create');
    Route::post('/', [PartitController::class, 'store'])->name('store');
});