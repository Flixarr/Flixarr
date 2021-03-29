<?php

namespace App\Listeners\MediaRequested;

use App\Events\MediaRequestedEvent;
use App\Models\API\TMDB;
use App\Models\Media;

class AddMediaToDatabase
{
    /**
     * Handle the event.
     *
     * @param  MediaRequestedEvent  $event
     * @return void
     */
    public function handle(MediaRequestedEvent $event)
    {
        $tmdbId = $event->tmdbId;
        $mediaType = $event->mediaType;

        $media = cache()->rememberForever($mediaType . '-' . $tmdbId, function () use ($tmdbId, $mediaType) {
            return (new TMDB)->getMedia($mediaType, $tmdbId, ['append_to_response' => 'credits,videos,images,similar_movies,recommendations,keywords,external_ids,changes,lists,reviews,release_dates,watch/providers']);
        });

        Media::firstOrCreate([
            'tmdb_id' => $tmdbId,
            'media_type' => $mediaType,
            'title' => $media['title'] ?? $media['name'],
            'backdrop_path' => $media['backdrop_path'] ?? null,
            'poster_path' => $media['poster_path'] ?? null,
            'user_id' => auth()->user()->id,
        ]);

    }
}
