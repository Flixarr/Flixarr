<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Tmdb extends Model
{
    public $url;
    public $params = [];

    public function __construct()
    {
        $this->url = 'https://api.themoviedb.org/3';
        $this->params = [
            'api_key' => config('tmdb.api_key'),
            'language' => 'en-US',
        ];
    }

    public function call(string $endpoint)
    {
        return Http::get($this->url . $endpoint, $this->params)->json();
    }

    /**
     * ======================================================================================
     */

    public function getMedia(string $mediaType, array $mediaFilter = [])
    {
        switch ($mediaType) {
            case 'movie':
                if (!$mediaFilter) {
                    return $this->call('/trending/movie/day');
                }
                break;
        }
    }

    public function getTrendingMedia(string $type = 'all', string $time = 'day', int $page = 1)
    {
        $this->params['page'] = $page;
        return $this->call('/trending/' . $type . '/' . $time);
    }
}
