<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CageController;
use App\Http\Controllers\ProfileController;
use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cages = Cage::withCount('animals')->get();
    $totalAnimals = Animal::count();
    return view('welcome', compact('cages', 'totalAnimals'));
})->name('home');

Route::get('/', [CageController::class, 'index'])->name('home');
Route::resource('cages', CageController::class)->only(['index', 'show']);
Route::resource('animals', AnimalController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('cages', CageController::class)->except(['index', 'show']);
    Route::resource('animals', AnimalController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';
