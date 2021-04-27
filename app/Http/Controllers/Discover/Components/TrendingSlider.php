<?php

namespace App\Http\Controllers\Discover\Components;

use App\Models\Api\TMDB;
use Livewire\Component;

class TrendingSlider extends Component
{
    public $media = [];

    public function render()
    {
        return view('web.discover.components.trending-slider');
    }

    public function load()
    {
        $this->media = (new TMDB)->returnTrendingMedia();

        $this->dispatchBrowserEvent('createMediaBackdropSlider', ['options' => [
            'type' => 'loop',
            'focus' => 'center',
            'fixedWidth' => '300px',
            'pagination' => false,
            'flickVelocityThreshold' => 50,
        ], 'divId' => "#discover-trending-slider", 'media' => $this->media]);
    }
}
