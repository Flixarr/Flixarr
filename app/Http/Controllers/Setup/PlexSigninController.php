<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;

class PlexSigninController extends Controller
{
    //

    public function view()
    {
        return view('web.setup.plex-signin');
    }
}
