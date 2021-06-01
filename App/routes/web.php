<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return cache('test', 'nothing');
});

Route::view('/loading', 'loading');

Route::name('setup.')->prefix('setup')->group(function () {
    Route::redirect('/', '/setup/tos');

    // TOS
    Route::get('/tos', [App\Http\Controllers\Pages\Setup\SetupController::class, 'tos'])->name('tos');
    Route::post('/tos', [App\Http\Controllers\Pages\Setup\TosController::class, 'agreeToTerms']);

    // Database
    Route::get('/database', [App\Http\Controllers\Pages\Setup\SetupController::class, 'database'])->name('database');
    Route::post('/database', [App\Http\Controllers\Pages\Setup\DatabaseController::class, 'saveDatabase']);

    // Plex
    Route::get('/plex', [App\Http\Controllers\Pages\Setup\SetupController::class, 'plex'])->name('plex');
    Route::get('/plex/servers', [App\Http\Controllers\Pages\Setup\SetupController::class, 'plexServers'])->name('plex.servers');
});
