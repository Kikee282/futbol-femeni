<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoresController;
use App\Http\Controllers\PartitsController;
use App\Http\Controllers\EstadisController;

Route::get('/', fn() => "Benvingut a la Guia d'Equips de Futbol Femení!");
Route::resource('equips', EquipController::class);

Route::get('/estadis', [EstadiController::class, 'index'])->name('estadis.index');
Route::get('/estadis/crear', [EstadiController::class, 'create'])->name('estadis.create');
Route::post('/estadis', [EstadiController::class, 'store'])->name('estadis.store');
Route::resource('/estadis', EstadiController::class);

Route::get('/jugadores', [JugadoresController::class, 'index'])->name('jugadores.index');
Route::get('/jugadores/crear', [JugadoresController::class, 'create'])->name('jugadores.create');
Route::post('/jugadores', [JugadoresController::class, 'store'])->name('jugadores.store');

Route::get('/partits', [PartitsController::class, 'index'])->name('partits.index');
Route::get('/partits/crear', [PartitsController::class, 'create'])->name('partits.create');
Route::post('/partits', [PartitsController::class, 'store'])->name('partits.store');

