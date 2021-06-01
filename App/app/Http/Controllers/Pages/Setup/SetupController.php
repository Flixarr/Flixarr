<?php

namespace App\Http\Controllers\Pages\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SetupController extends Controller
{
    public function tos()
    {
        return view('pages.setup.tos', ['title' => 'Terms of Service']);
    }

    public function database()
    {
        return view('pages.setup.database', ['title' => 'Database Setup']);
    }

    public function plex()
    {
        return view('pages.setup.plex', ['title' => 'Plex Setup']);
    }

    public function plexServers()
    {
        return view('pages.setup.plex-server', ['title' => 'Plex Server(s)']);
    }
}
