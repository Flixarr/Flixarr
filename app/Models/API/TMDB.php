<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class TMDB extends Model
{

    public $url;
    public $params = [];

    public function __construct()
    {
        $this->url = config('tmdb.url') . '/' . config('tmdb.version');
        $this->params = [
            'api_key' => config('tmdb.key'),
            'language' => 'en-US',
        ];
    }

    public function call(string $endpoint)
    {
        return Http::get($this->url . $endpoint, $this->params)->json();
    }

    //----------------------------------------------------------------------
    //----------------------------------------------------------------------
    //----------------------------------------------------------------------

    public function discover(string $media_type, array $params = [])
    {
        if ($params) {
            foreach ($params as $key => $param) {
                $this->params[$key] = $param;
            }
        }

        return $this->call('/discover/' . $media_type)['results'];
    }

    public function getTrendingMedia(string $media_type = 'all', string $time_window = 'day')
    {
        return $this->call('/trending/' . $media_type . '/' . $time_window)['results'];
    }

    public function getPopularMedia(string $media_type = 'movie', array $params = [])
    {
        if ($params) {
            foreach ($params as $key => $param) {
                $this->params[$key] = $param;
            }
        }
        return $this->call('/' . $media_type . '/popular')['results'];
    }

    //----------------------------------------------------------------------

    public function getMedia(string $media_type, int $media_id, array $params = [])
    {
        if ($params) {
            foreach ($params as $key => $param) {
                $this->params[$key] = $param;
            }
        }

        return $this->call('/' . $media_type . '/' . $media_id);
    }

    public function getGenres(string $media_type)
    {
        return $this->call('/genre/' . $media_type . '/list')['genres'];
    }
}
