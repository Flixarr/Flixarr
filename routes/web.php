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
        Route::get('/sign-in', App\Http\Controllers\Setup\Login::class);
        Route::get('/servers', App\Http\Controllers\Setup\PlexServers::class);
    });
});

/**
 * Auth Routes
 */
Route::middleware(['setup', 'guest'])->group(function () {
    Route::name('login')->get('/login', App\Http\Controllers\Auth\Login::class);
});

/**
 * Frontend Routes
 */
Route::middleware(['setup', 'auth'])->group(function () {
    Route::get('/', App\Http\Controllers\Discover\Discover::class);
});
