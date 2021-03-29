<?php

namespace App\Http\Web\Dashboard\Media\Components;

use App\Events\MediaRequestedEvent;
use App\Models\API\Sonarr;
use App\Models\Media;
use Livewire\Component;

class Controls extends Component
{
    public $tmdbId;
    public $mediaType;
    public $status;
    public $seasons;

    public function render()
    {
        return view('web.dashboard.media.components.controls');
    }

    public function mount(int $tmdbId, string $mediaType)
    {
        $this->tmdbId = $tmdbId;
        $this->mediaType = $mediaType;
    }

    public function refresh()
    {
        $this->load();
    }

    public function load()
    {
        if ($request = Media::where('tmdb_id', $this->tmdbId)->where('media_type', $this->mediaType)->first()) {
            $this->status = $request['status'];

            if ($this->status == 'series') {
                $this->seasons = (new Sonarr)->getSeriesById($request['downloader_id'])['seasons'];
            }
        } else {
            $this->status = 'requestable';
        }
    }

    public function request()
    {
        event(new MediaRequestedEvent($this->tmdbId, $this->mediaType));

        $this->dispatchBrowserEvent('alert-success', ['time' => '3500', 'title' => 'Request Sent!', 'message' => 'Your request has been sent successfully.']);
        $this->load();
    }
}
