<?php

namespace App\Http\Web\Dashboard\Discover\Components;

use App\Models\API\TMDB;
use Livewire\Component;

class Genres extends Component
{
    public $media_type;
    public $genres = [];

    public function render()
    {
        return view('web.dashboard.discover.components.genres');
    }

    public function mount($media_type)
    {
        $this->media_type = $media_type;
    }

    public function loadMovieGenres()
    {
        $this->genres = cache()->rememberForever('genres-' . $this->media_type, function () {
            return (new TMDB)->getGenres($this->media_type);
        });
    }
}
