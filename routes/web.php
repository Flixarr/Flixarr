<?php

use App\Http\Web\User\Settings\SettingsControler;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

//Route::middleware(['app-setup'])->group(function () {

Route::middleware(['guest'])->group(function () {
    Route::name('login')->get('/login', App\Http\Web\Auth\Login::class);
});

Route::middleware(['auth'])->group(function () {
    // Logout
    Route::get('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    });

    Route::get('/setup', App\Http\Web\Auth\Setup::class);

    Route::middleware(['user-setup'])->group(function () {

        Route::name('dashboard.')->group(function () {
            Route::name('index')->get('/', App\Http\Web\Dashboard\Index::class);
            Route::name('discover')->get('/discover', App\Http\Web\Dashboard\Discover\DiscoverController::class);
            Route::name('movie')->get('/movie/{tmdbId}', App\Http\Web\Dashboard\Media\MovieController::class);
            Route::name('tv')->get('/tv/{tmdbId}', App\Http\Web\Dashboard\Media\TvController::class);
            Route::name('search')->get('/search', App\Http\Web\Dashboard\Search\SearchController::class);
        });

        Route::name('user.')->prefix('user')->group(function () {
            Route::name('settings')->get('/settings', App\Http\Web\User\Settings\SettingsControler::class);
        });

    });
});

//});

Route::get('/app-setup', App\Http\Web\App\Setup::class);

Route::get('/loading', function () {
    return 'loading...';
});

Route::get('/reset', function () {
    Artisan::call('migrate:fresh --seed');
    Artisan::call('optimize:clear');
    Artisan::call('key:generate');

    return redirect('/');
});
