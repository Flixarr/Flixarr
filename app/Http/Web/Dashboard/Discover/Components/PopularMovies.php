<?php

namespace App\Http\Web\Dashboard\Discover\Components;

use App\Models\API\TMDB;
use Livewire\Component;

class PopularMovies extends Component
{
    public $media = [];
    public $genres = [];
    public $selected_genre_id;

    protected $listeners = ['genreSelected' => 'updateGenre'];

    public function render()
    {
        return view('web.dashboard.discover.components.popular-movies');
    }

    public function load()
    {
        $this->media = cache()->remember('discover-popular-movies', config('cache.remember_time'), function () {
            return (new TMDB)->getPopularMedia('movie');
        });
    }

    public function updateGenre($genre_id)
    {
        if ($genre_id != $this->selected_genre_id) {
            $this->selected_genre_id = $genre_id;
            $this->media = cache()->remember('popular-movies-with-genre-' . $genre_id, config('cache.remember_time'), function () use ($genre_id) {
                return (new TMDB)->discover('movie', ['sort_by' => 'popularity.desc', 'with_genres' => $genre_id]);
            });
        }

    }

}
