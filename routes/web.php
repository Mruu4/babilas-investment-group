<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/real-estate', [App\Http\Controllers\RealEstatePageController::class, 'index'])->name('real-estate.index');
Route::get('/real-estate/{slug}', [App\Http\Controllers\RealEstatePageController::class, 'show'])->name('real-estate.show');
Route::get('/agriculture', [App\Http\Controllers\AgriculturePageController::class, 'index'])->name('agriculture.index');
Route::get('/agriculture/{slug}', [App\Http\Controllers\AgriculturePageController::class, 'show'])->name('agriculture.show');
Route::get('/technology', [App\Http\Controllers\TechnologyPageController::class, 'index'])->name('technology.index');
Route::get('/technology/{slug}', [App\Http\Controllers\TechnologyPageController::class, 'show'])->name('technology.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'role_or_permission:Super Admin|Content Manager|Investment Manager|Editor'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
