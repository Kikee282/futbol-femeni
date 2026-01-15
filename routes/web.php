<?php

use App\Http\Controllers\ProfileController;
use App\Mail\ResumPartitsArbitre;
use App\Models\Partit;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;



// --- RUTA HOME ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

// --- RUTA DASHBOARD ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- RUTAS DE PERFIL ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- RUTES EQUIPS ---
Route::prefix('equips')->name('equips.')->group(function () {
    
    // 1. SOLO ADMINISTRADORES (Crear y Eliminar)
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/crear', [EquipController::class, 'create'])->name('create');
        Route::post('/', [EquipController::class, 'store'])->name('store');
        Route::delete('/{equip}', [EquipController::class, 'destroy'])->name('destroy');
    });

    // 2. MANAGERS Y ADMINS (Editar)
    Route::middleware(['auth'])->group(function () {
        Route::get('/{equip}/editar', [EquipController::class, 'edit'])->name('edit');
        Route::put('/{equip}', [EquipController::class, 'update'])->name('update');
    });

    // 3. PÚBLICAS (Ver listado y detalles)
    Route::get('/', [EquipController::class, 'index'])->name('index');
    Route::get('/{equip}', [EquipController::class, 'show'])->name('show');
});

// --- RUTES ESTADIS ---
Route::prefix('estadis')->name('estadis.')->group(function () {
    
    // 1. SOLO ADMINISTRADORES (Crear, Editar, Eliminar)
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/crear', [EstadiController::class, 'create'])->name('create');
        Route::post('/', [EstadiController::class, 'store'])->name('store');
        Route::get('/{estadi}/editar', [EstadiController::class, 'edit'])->name('edit');
        Route::put('/{estadi}', [EstadiController::class, 'update'])->name('update');
        Route::delete('/{estadi}', [EstadiController::class, 'destroy'])->name('destroy');
    });

    // 2. PÚBLICAS
    Route::get('/', [EstadiController::class, 'index'])->name('index');
    Route::get('/{estadi}', [EstadiController::class, 'show'])->name('show');
});

Route::prefix('jugadores')->name('jugadores.')->group(function () {
    
    // 1. SOLO ADMINISTRADORES (Gestión Total)
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/crear', [JugadoraController::class, 'create'])->name('create');
        Route::post('/', [JugadoraController::class, 'store'])->name('store');
        Route::get('/{jugadora}/editar', [JugadoraController::class, 'edit'])->name('edit');
        Route::put('/{jugadora}', [JugadoraController::class, 'update'])->name('update');
        Route::delete('/{jugadora}', [JugadoraController::class, 'destroy'])->name('destroy');
    });

    // 2. PÚBLICAS
    Route::get('/', [JugadoraController::class, 'index'])->name('index');
    Route::get('/{jugadora}', [JugadoraController::class, 'show'])->name('show');
});

// --- RUTES PARTITS ---
Route::prefix('partits')->name('partits.')->group(function () {
    
    // 1. ÁRBITROS Y ADMINS (Editar Resultados)
    Route::middleware(['auth'])->group(function () {
        Route::get('/{partit}/editar', [PartitController::class, 'edit'])->name('edit');
        Route::put('/{partit}', [PartitController::class, 'update'])->name('update');
    });

    // 2. PÚBLICAS
    Route::get('/', [PartitController::class, 'index'])->name('index');
    Route::get('/{partit}', [PartitController::class, 'show'])->name('show');
});

// --- NOTIFICACIONES ---
Route::get('/notificar-arbitres', function () {
    $arbitres = User::where('role', 'arbitre')->get();
    $enviats = 0;

    foreach ($arbitres as $arbitre) {
        $partits = Partit::where('arbitre', $arbitre->name)
                        ->where('data', '>=', now()) 
                        ->orderBy('data')
                        ->get();

        if ($partits->count() > 0) {
            Mail::to($arbitre->email)->send(new ResumPartitsArbitre($arbitre, $partits));
            $enviats++;
        }
    }

    return "S'han enviat $enviats correus als àrbitres correctament! 📧";
})->middleware(['auth', 'role:admin']); 

// --- CLASSIFICACIÓ ---
Route::get('/classificacio', function () {
    return view('classificacio-page');
})->name('classificacio');

// Carga las rutas de autenticación
require __DIR__.'/auth.php';