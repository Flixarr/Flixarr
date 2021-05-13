<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('setup')->group(function () {
    Route::get('/', function () {
        return 'yes';
    });
});
