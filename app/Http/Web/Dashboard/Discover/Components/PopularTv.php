<?php

namespace App\Http\Web\Dashboard\Discover\Components;

use App\Models\API\TMDB;
use Livewire\Component;

class PopularTv extends Component
{
    public $media = [];
    public $genres = [];

    protected $listeners = ['genreSelected' => 'updateGenre'];

    public function render()
    {
        return view('web.dashboard.discover.components.popular-tv');
    }

    public function load()
    {
        $this->media = cache()->remember('discover-popular-tv', config('cache.remember_time'), function () {
            return (new TMDB)->getPopularMedia('tv');
        });
    }

    public function updateGenre($genreId)
    {
        $this->media = cache()->remember('discover-popular-tv-with-genre-' . $genreId, config('cache.remember_time'), function () use ($genreId) {
            return (new TMDB)->discover('tv', ['sort_by' => 'popularity.desc', 'with_genres' => $genreId]);
        });
    }
}
