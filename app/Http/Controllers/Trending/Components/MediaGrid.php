<?php

namespace App\Http\Controllers\Trending\Components;

use App\Models\API\Tmdb;
use Livewire\Component;

class MediaGrid extends Component
{
    public $media;
    public $type;
    public $page;

    protected $listeners = ['setMediaType', 'loadMore'];

    public function mount()
    {
        $this->type = 'movie';
        $this->page = 1;
    }

    public function render()
    {
        return view('web.trending.components.media-grid');
    }

    public function loadMedia()
    {
        $this->media = (new Tmdb)->getTrending($this->type)['results'];
    }

    public function loadMore()
    {
        $this->page++;
        $this->media = array_merge($this->media, (new Tmdb)->getTrending($this->type, $this->page)['results']);
    }

    public function setMediaType($type)
    {
        $this->type = $type;
        $this->loadMedia();
    }

    public function test($id)
    {
        $this->emit('openMediaModal', $id);
    }
}
