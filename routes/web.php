<?php

use Illuminate\Support\Facades\Route;

/**
 * Frontend Routes
 */

Route::middleware(['auth'])->group(function () {
    Route::get('/', App\Http\Controllers\Discover\Discover::class);
});
