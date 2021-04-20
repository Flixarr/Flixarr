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
        sleep(2);
        $this->netflixMedia = (new Tmdb)->discover('movie', ['watch_region' => 'US', 'with_watch_providers' => '8'])['results'];
    }

}
