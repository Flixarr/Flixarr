<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Controllers\Discover\Discover::class);

// Route::get('/{mediaType}/{tmdbId}', App\Http\Controllers\Media\Media::class);
