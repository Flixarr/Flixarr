<?php

namespace App\Http\Controllers\Components\Modals;

use App\Models\API\Tmdb;
use Livewire\Component;

class MediaModal extends Component
{
    public $media;
    public $mediaType;

    // protected $listeners = [
    //     'openModal' => 'load',
    //     'closeModal' => 'close',
    // ];

    public function render()
    {
        return view('components.modals.media-modal');
    }

    public function load($tmdbId, $mediaType)
    {
        $this->media = (new Tmdb)->getMedia($tmdbId, $mediaType);
        $this->mediaType = $mediaType;
        $this->buildMediaInfo();
        $this->removeVideosThatAreNotOnYoutube();
    }

    public function close()
    {
        $this->media = [];
    }

    public function buildMediaInfo()
    {
        // get director
        foreach ($this->media['credits']['crew'] as $crew) {
            if ($crew['job'] === "Director") {
                $this->media['director']['id'] = $crew['id'];
                $this->media['director']['name'] = $crew['name'];
            }
        }
    }

    public function removeVideosThatAreNotOnYoutube()
    {
        $videos = [];

        foreach ($this->media['videos']['results'] as $video) {
            if ($video['site'] == 'YouTube') {
                $videos[] = $video;
            }

        }
        $this->media['videos'] = $videos;
    }

}
