<?php

namespace App\Listeners\MediaRequested;

use App\Events\MediaRequestedEvent;
use App\Events\MovieRequested;
use App\Models\API\Radarr;
use App\Models\API\Sonarr;
use App\Models\Media;

class AddToArr
{

    /**
     * Handle the event.
     *
     * @param  MovieRequested  $event
     * @return void
     */
    public function handle(MediaRequestedEvent $event)
    {
        $tmdbId = $event->tmdbId;
        $mediaType = $event->mediaType;

        if ($mediaType == 'movie') {

            // Add movie to Radarr and grab the movie data from Radarr
            $radarrData = (new Radarr)->addMovie($tmdbId);

            // Check if Radarr sent any errors
            if (isset($radarrData[0]['errorMessage'])) {

                // Radarr said there was a problem
                return;

            } else {

                // Update Movie in the database with Radarr data
                $localData = Media::where('tmdb_id', $radarrData['tmdbId'])->first();
                $localData->downloader_id = $radarrData['id'];
                $localData->save();

            }

        } elseif ($mediaType == 'tv') {

            $sonarrData = (new Sonarr)->addSeries($tmdbId);

            // Check if Radarr sent any errors
            if (isset($sonarrData[0]['errorMessage'])) {
                return;
            } else {
                $localData = Media::where('tmdb_id', $tmdbId)->first();
                $localData->downloader_id = $sonarrData['id'];
                $localData->status = 'series';
                $localData->save();
            }
        }
    }
}
