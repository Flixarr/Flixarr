<?php

namespace App\Http\Controllers\Components\Media;

use App\Models\Api\TMDB;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Poster extends Component
{
    public $tmdbId;
    public $mediaType;
    public $contentIsVisible = false;

    public $media;

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.media.poster');
    }

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function mount(string $tmdbId, string $mediaType)
    {
        $this->tmdbId = $tmdbId;
        $this->mediaType = $mediaType;

        $this->media = Cache::rememberForever($this->mediaType . $this->tmdbId, function () {
            return (new TMDB)->getMedia($this->tmdbId, $this->mediaType);
        });
    }

    public function setContent()
    {
        $this->contentIsVisible = true;
    }
}
