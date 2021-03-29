<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Radarr extends Model
{
    public $url;
    public $key;

    public function __construct()
    {
        $this->url = config('radarr.host') . ':' . config('radarr.port') . '/api/v3';
        $this->key = config('radarr.key');
    }

    public function call($endpoint, array $params = [], $type = "get")
    {
        if ($type == 'get') {
            $params['apiKey'] = $this->key;
            $response = Http::get($this->url . $endpoint, $params);
        } elseif ($type == 'post') {
            $response = Http::withHeaders([
                'X-API-Key' => $this->key,
            ])->post($this->url . $endpoint, $params);
        } elseif ($type == 'put') {
            $response = Http::withHeaders([
                'X-API-Key' => $this->key,
            ])->put($this->url . $endpoint, $params);
        }

        return $response->json();
    }

    public function getQueue()
    {
        return $this->call('/queue', ['pageSize' => '99'])['records'];
    }

    // =================================================================================

    public function returnAllMovies()
    {
        return $this->call('/movie');
    }

    public function getMovieByTmdbId($radarrMovieId)
    {
        return $this->call('/movie/' . $radarrMovieId);
    }

    public function getMovieById($id)
    {
        $movie = $this->call('/movie/' . $id);

        return $movie ?? false;
    }

    public function addMovie($tmdbId)
    {
        // must make this call to get the correct Folder name for movies with weird characters..
        // I'm not sure what radarr uses to sanitize their folder names - https://github.com/Radarr/Radarr/blob/bef12f10a879c3c46c28e5fa5d5a60e9b73b5e15/src/NzbDrone.Core/Parser/Parser.cs#L427
        $movie = $this->call('/movie/lookup', ['term' => 'tmdb:' . $tmdbId]);

        $newMovie = [
            'id' => 0,
            'QualityProfileId' => 7,
            'path' => '\\\\SYNO\Plex\Library\Movies\\' . $movie[0]['folder'],
            'title' => $movie[0]['title'],
            'tmdbId' => $tmdbId,
            'addOptions' => [
                'searchForMovie' => true,
            ],
        ];

        return $this->call('/movie', $newMovie, 'post');
    }

    // public function searchMovie($tmdbId)
    // {
    //     $allMovies = $this->returnAllMovies();

    //     foreach ($allMovies as $movie) {
    //         if ($movie['tmdbId'] == $tmdbId) {
    //             $updatedMovie = [
    //                 'id' => $movie['id'],
    //                 'qualityProfileId' => $movie['qualityProfileId'],
    //                 'path' => $movie['path'],
    //                 'tmdbId' => $tmdbId,
    //                 'addOptions' => [
    //                     'searchForMovie' => true,
    //                 ],
    //             ];

    //             // update movie to search
    //             $this->call('/movie', $updatedMovie, 'put');
    //             $command = [
    //                 'name' => 'RefreshMovie',
    //                 'movieId' => $movie['id'],
    //             ];
    //             return $this->call('/command', $command, 'post');
    //         }
    //     }
    // }

    public function isMovieInQueue($id)
    {
        $queue = $this->getQueue();

        foreach ($queue as $item) {
            if ($item['movieId'] == $id) {
                return $item;

            }
        }

        return false;
    }

    // =================================================================================

    public function totalMovieCount()
    {
        return count($this->returnAllMovies());
    }

    public function actualMovieCount()
    {
        return count($this->call('/moviefile'));
    }

    // What?
    public function numberOfActiveByUser()
    {
        $count = 0;
        $moviesInQueue = collect($this->getQueue());

        foreach ($moviesInQueue as $movie) {
            $tmdbId = $this->getMovie($movie['movieId'])['tmdbId'];

            $request = MediaRequest::where('tmdb_id', $tmdbId)->first();

            if ($request && $request->user_id == auth()->user()->id) {
                $count++;
            }
        }

        return $count;
    }

}
