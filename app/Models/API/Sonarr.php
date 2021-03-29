<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Sonarr extends Model
{
    public $url;
    public $key;

    public function __construct()
    {
        $this->url = config('sonarr.host') . ':' . config('sonarr.port') . '/api';
        $this->key = config('sonarr.key');
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

    public function addSeries(int $tmdbId)
    {

        $media = cache()->rememberForever('tv-' . $tmdbId, function () use ($tmdbId) {
            return (new TMDB)->getMedia('tv', $tmdbId, ['append_to_response' => 'credits,videos,images,similar_movies,recommendations,keywords,external_ids,changes,lists,reviews,release_dates,watch/providers']);
        });

        if (!isset($media['external_ids']['tvdb_id'])) {
            $term = $media['name'] . ' ' . substr($media['first_air_date'], 0, 4);
        } else {
            $term = 'tvdb:' . $media['external_ids']['tvdb_id'];
        }

        $sonarData = $this->call('/series/lookup', ['term' => $term])[0];

        $newSeries = [
            'tvdbId' => $sonarData['tvdbId'],
            'title' => $sonarData['title'],
            'profileId' => 1,
            'titleSlug' => $sonarData['titleSlug'],
            'images' => $sonarData['images'],
            'seasons' => $sonarData['seasons'],
            'path' => '\\\\SYNO\Plex\Library\TV Shows\\' . $sonarData['title'],
            'tvRageId' => $sonarData['tvRageId'],
            'seasonFolder' => true,
            'monitored' => true,
            'addOptions' => [
                'searchForMissingEpisodes' => true,
            ],
        ];

        return $this->call('/series', $newSeries, 'post');
    }

    public function getAllSeries()
    {
        return $this->call('/series');
    }

    public function getSeriesById($id)
    {
        $series = $this->call('/series/' . $id);

        return $series ?? false;
    }

    public function isSeriesInQueue($id)
    {
        $queue = $this->call('/queue');

        foreach ($queue as $item) {
            if ($item['series']['id'] == $id) {
                return $item;
            }
        }

        return false;
    }

}
