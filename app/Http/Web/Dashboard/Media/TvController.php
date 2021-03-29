<?php

namespace App\Http\Web\Dashboard\Media;

use App\Models\API\TMDB;
use App\Models\Media;
use Livewire\Component;

class TvController extends Component
{
    public $media;
    public $tmdbId;
    public $trailerId;

    public $str;

    public function render()
    {
        return view('web.dashboard.media.tv');
    }

    public function mount(int $tmdbId)
    {
        $this->tmdbId = $tmdbId;
        $this->str = \Illuminate\Support\Str::class;

        // dd(Media::refreshDownloadStatus());
    }

    public function load()
    {
        $this->media = cache()->rememberForever('tv-' . $this->tmdbId, function () {
            return (new TMDB)->getMedia('tv', $this->tmdbId, ['append_to_response' => 'credits,videos,images,similar_movies,recommendations,keywords,external_ids,changes,lists,reviews,release_dates,watch/providers']);
        });

        $this->media['credits']['crew'] = collect($this->media['credits']['crew'])->take(5)->toArray();

        $this->getTrailerId();
    }

    public function getTrailerId()
    {
        if (isset($this->media['videos']['results'])) {
            foreach ($this->media['videos']['results'] as $video) {
                if ($video['type'] == 'Trailer' && $video['site'] == 'YouTube') {
                    $this->trailerId = $video['key'];
                }
            }
        }
    }
}
