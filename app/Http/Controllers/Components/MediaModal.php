<?php

namespace App\Http\Controllers\Components;

use App\Models\API\Tmdb;
use Livewire\Component;

class MediaModal extends Component
{
    public $isOpen;

    public $tmdbId;
    public $media;

    protected $listeners = ['openMediaModal' => 'open'];

    public function render()
    {
        return view('web.components.media-modal');
    }

    public function open($tmdbId)
    {
        $this->isOpen = true;
        $this->tmdbId = $tmdbId;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->tmdbId = null;
        $this->media = [];
    }

    public function loadMedia()
    {
        $this->media = (new Tmdb)->getMedia($this->tmdbId);
    }

    public function test()
    {
        // sleep(2);
        // dd(4);
    }
}
