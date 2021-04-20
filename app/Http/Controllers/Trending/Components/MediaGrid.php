<?php

namespace App\Http\Controllers\Trending\Components;

use App\Models\API\Tmdb;
use Livewire\Component;

class MediaGrid extends Component
{
    public $media;
    public $mediaType;
    public $page;

    public $modalIsOpen;

    protected $listeners = ['setMediaType', 'loadMore'];

    public function mount()
    {
        $this->mediaType = 'movie';
        $this->page = 1;
    }

    public function render()
    {
        return view('web.trending.components.media-grid');
    }

    public function loadMedia()
    {
        $this->media = (new Tmdb)->getTrending($this->mediaType)['results'];
    }

    public function loadMore()
    {
        $this->page++;
        $this->media = array_merge($this->media, (new Tmdb)->getTrending($this->mediaType, $this->page)['results']);
    }

    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;
        $this->loadMedia();
    }

    public function openModal($tmdbId)
    {
        $this->dispatchBrowserEvent('modal', $tmdbId);
    }

}
