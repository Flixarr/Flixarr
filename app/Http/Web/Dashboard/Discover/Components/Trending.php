<?php

namespace App\Http\Web\Dashboard\Discover\Components;

use App\Models\API\TMDB;
use Livewire\Component;

class Trending extends Component
{
    public $media = [];

    public function render()
    {
        return view('web.dashboard.discover.components.trending');
    }

    public function load()
    {
        $this->media = cache()->remember('discover-trending-today', config('cache.remember_time'), function () {
            return (new TMDB)->getTrendingMedia('all', 'day');
        });
    }
}
