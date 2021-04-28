<?php

namespace App\View\Components\Media;

use App\Models\Api\TMDB;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Poster extends Component
{
    public $tmdbId;
    public $mediaType;

    public $media;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $tmdbId, string $mediaType)
    {
        $this->tmdbId = $tmdbId;
        $this->mediaType = $mediaType;

        $this->media = Cache::rememberForever($this->mediaType . $this->tmdbId, function () {
            return (new TMDB)->getMedia($this->tmdbId, $this->mediaType);
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.media.poster');
    }
}
