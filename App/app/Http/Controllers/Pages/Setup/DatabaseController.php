<?php

namespace App\Http\Controllers\Pages\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function saveDatabase(Request $request)
    {
        return redirect()->route('setup.plex');
    }
}
