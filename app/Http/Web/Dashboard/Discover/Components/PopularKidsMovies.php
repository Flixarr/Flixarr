<?php

namespace App\Http\Web\Dashboard\Discover\Components;

use App\Models\API\TMDB;
use Livewire\Component;

class PopularKidsMovies extends Component
{
    public $media = [];

    public function render()
    {
        return view('web.dashboard.discover.components.popular-kids-movies');
    }

    public function load()
    {
        $this->media = cache()->remember('discover-popular-kids-movies', config('cache.remember_time'), function () {
            return (new TMDB)->discover('movie', ['certification_country' => 'US', 'certification' => 'G', 'sort_by' => 'popularity.desc']);
        });
    }
}
