<?php

use Illuminate\Support\Facades\Route;

/**
 * Util Routes
 */
Route::get('/loading', function () {
    return view('layouts.loading');
});

/**
 * Setup Routes
 */
Route::prefix('setup')->group(function () {
    Route::redirect('/', '/setup/plex/sign-in');
    Route::prefix('/plex')->group(function () {
        Route::get('/sign-in', [App\Http\Controllers\Setup\PlexSigninController::class, 'view']);
        Route::get('/servers', [App\Http\Controllers\Setup\PlexServersController::class, 'view']);
    });
});

Route::middleware(['setup'])->group(function () {
    Route::redirect('/', '/discover');

    Route::prefix('discover')->group(function () {
        Route::name('discover')->get('/', [App\Http\Controllers\Discover\DiscoverController::class, 'view']);
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
