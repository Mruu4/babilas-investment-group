<?php

use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\AgricultureProjectController;
use App\Http\Controllers\Admin\TechnologyProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role_or_permission:Super Admin|Content Manager|Investment Manager|Editor'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('properties', PropertyController::class)
            ->middleware('role_or_permission:Super Admin|Content Manager');
        Route::delete('properties/images/{image}', [PropertyController::class, 'destroyImage'])
            ->name('properties.images.destroy')
            ->middleware('role_or_permission:Super Admin|Content Manager');

        Route::resource('agriculture', AgricultureProjectController::class)
            ->parameters(['agriculture' => 'agricultureProject'])
            ->middleware('role_or_permission:Super Admin|Content Manager|Investment Manager');
        Route::delete('agriculture/media/{media}', [AgricultureProjectController::class, 'destroyMedia'])
            ->name('agriculture.media.destroy')
            ->middleware('role_or_permission:Super Admin|Content Manager|Investment Manager');

        Route::resource('technology', TechnologyProjectController::class)
            ->parameters(['technology' => 'technologyProject'])
            ->middleware('role_or_permission:Super Admin|Content Manager|Investment Manager');
        Route::delete('technology/media/{media}', [TechnologyProjectController::class, 'destroyMedia'])
            ->name('technology.media.destroy')
            ->middleware('role_or_permission:Super Admin|Content Manager|Investment Manager');

    });
