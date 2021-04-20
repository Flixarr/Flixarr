<?php

namespace App\Http\Controllers\Index\Components;

use App\Models\API\Tmdb;
use Livewire\Component;

class NetflixTv extends Component
{
    public $netflixMedia;

    public function render()
    {
        return view('web.index.components.netflix-tv');
    }

    public function loadNetflixTv()
    {
        $this->netflixMedia = (new Tmdb)->mediaByProvider('amazon', 'tv')['results'];

        // dd($this->netflixMedia);

    }

}
