<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CageController;
use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cages = Cage::withCount('animals')->get();
    $totalAnimals = Animal::count();
    return view('welcome', compact('cages', 'totalAnimals'));
})->name('home');

// Route::resource('cages', CageController::class)->only(['index', 'show']);
// Route::resource('animals', AnimalController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    // Route::resource('cages', CageController::class)->except(['index', 'show']);
    // Route::resource('animals', AnimalController::class)->except(['index', 'show']);
    Route::prefix('cages')->group(function () {
        Route::get('/create', [CageController::class, 'create'])->name('cages.create');
        Route::post('/', [CageController::class, 'store'])->name('cages.store');
        Route::get('/{cage}/edit', [CageController::class, 'edit'])->name('cages.edit');
        Route::put('/{cage}', [CageController::class, 'update'])->name('cages.update');
        Route::delete('/{cage}', [CageController::class, 'destroy'])->name('cages.destroy');
    });
    Route::prefix('animals')->group(function () {
        Route::get('/create', [AnimalController::class, 'create'])->name('animals.create');
        Route::post('/', [AnimalController::class, 'store'])->name('animals.store');
        Route::get('/{animal}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
        Route::put('/{animal}', [AnimalController::class, 'update'])->name('animals.update');
        Route::delete('/{animal}', [AnimalController::class, 'destroy'])->name('animals.destroy');
    });
});

Route::prefix('cages')->group(function () {
    Route::get('/cages', [CageController::class, 'index'])->name('cages.index');
    Route::get('/cages/{cage}', [CageController::class, 'show'])->name('cages.show');
});

Route::prefix('animals')->group(function () {
    Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
    Route::get('/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');
});

require __DIR__.'/auth.php';
