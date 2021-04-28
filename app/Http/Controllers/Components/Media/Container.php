<?php

namespace App\Http\Controllers\Components\Media;

use App\Models\Api\TMDB;
use Livewire\Component;

class Container extends Component
{
    public $containerType;
    public $title;
    public $moreLink;
    public $tmdbEndpoint;
    public $mediaType;
    public $tmdbParams;

    public $media = [];

    public function render()
    {
        return view('components.media.container');
    }

    /**
     * @param string $containerType The container type ('grid', 'scroll')
     * @param string $title The title of the container
     * @param string $moreLink The endpoint for the "See More" link. If it's empty, "See More" will be hidden
     */
    public function mount(string $containerType, string $title, string $tmdbEndpoint, string $mediaType, array $tmdbParams = [], string $moreLink = '')
    {
        $this->containerType = $containerType;
        $this->title = $title;
        $this->tmdbEndpoint = $tmdbEndpoint;
        $this->mediaType = $mediaType;
        $this->tmdbParams = $tmdbParams;
        $this->moreLink = $moreLink;
    }

    public function load()
    {
        $this->media = (new TMDB)->call($this->tmdbEndpoint)['results'];
    }
}
