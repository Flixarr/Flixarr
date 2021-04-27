<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class TMDB extends Model
{
    public $url;
    public $params = [];

    public function __construct()
    {
        if (empty(config('tmdb.api_key'))) {
            abort(500, 'TMDB API Key is missing');
        }

        $this->url = 'https://api.themoviedb.org/3';
        $this->params = [
            'api_key' => config('tmdb.api_key'),
            'language' => 'en-US',
            'region' => 'US',
            'watch_region' => 'US',
        ];
    }

    public function call(string $endpoint, array $params = [])
    {
        if ($params) {
            foreach ($params as $key => $value) {
                $this->params[$key] = $value;
            }
        }

        return Http::get($this->url . $endpoint, $this->params)->json();
    }

    /**
     * Utilities
     */

    public function test($endpoint = null, $params = null)
    {
        $params = $params->all();

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $this->params[$key] = $value;
            }
        }

        return $this->call('/' . $endpoint);
    }

    public static function addImageUrl($backdropPath)
    {
        return 'https://image.tmdb.org/t/p/w500' . $backdropPath;
    }

    /**
     *
     */

    public function returnTrendingMedia($mediaType = 'all', $timeWindow = 'day', $page = null)
    {
        if ($page) {
            $this->params['page'] = $page;
        }

        return $this->call('/trending/' . $mediaType . '/' . $timeWindow)['results'];
    }

    public function returnRandomBackdropPath($withTmdbImageUrl = false)
    {
        $trendingMedia = $this->returnTrendingMedia();

        $randomItem = Arr::random($trendingMedia);

        while (!isset($randomItem['backdrop_path'])) {
            $randomItem = Arr::random($trendingMedia);
        }

        if ($withTmdbImageUrl) {
            return 'https://image.tmdb.org/t/p/w500/' . $randomItem['backdrop_path'];
        } else {
            return $randomItem['backdrop_path'];
        }
    }

}
