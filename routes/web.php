<?php

use App\Models\API\Tmdb;
use Illuminate\Http\Request;
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
    Route::name('index')->get('/', [App\Http\Controllers\Index\IndexController::class, 'view']);

    Route::prefix('trending')->group(function () {
        Route::name('trending')->get('/', [App\Http\Controllers\Trending\TrendingController::class, 'view']);
    });

Route::get('/tmdb/{endpoint}', function (Request $params, $endpoint) {
    return (new Tmdb)->test($endpoint, $params);
})->where('endpoint', '(.*)');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
