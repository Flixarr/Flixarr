<?php

namespace App\Http\Controllers\Trending;

use App\Http\Controllers\Controller;

class TrendingController extends Controller
{
    public function view()
    {
        return view('web.trending.trending');
    }
}
