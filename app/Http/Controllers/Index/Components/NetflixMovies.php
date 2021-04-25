<?php

namespace App\Http\Controllers\Index\Components;

use App\Models\API\Tmdb;
use Livewire\Component;

class NetflixMovies extends Component
{
    public $netflixMedia;

    public function render()
    {
        return view('web.index.components.netflix-movies');
    }

    public function loadNetflixMovies()
    {
        $this->netflixMedia = (new Tmdb)->mediaByProvider('netflix', 'movie')['results'];
    }

}
