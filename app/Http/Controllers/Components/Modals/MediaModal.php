<?php

namespace App\Http\Controllers\Components\Modals;

use App\Models\API\Tmdb;
use Livewire\Component;

class MediaModal extends Component
{
    public $media;

    // protected $listeners = [
    //     'openModal' => 'load',
    //     'closeModal' => 'close',
    // ];

    public function render()
    {
        return view('components.modals.media-modal');
    }

    public function loadM($tmdbId)
    {
        $this->media = (new Tmdb)->getMedia($tmdbId);
    }

    public function close()
    {
        $this->media = [];
    }

}
