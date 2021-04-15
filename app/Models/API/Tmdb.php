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

    /**
     * Get the daily or weekly trending items
     *
     * @param string $mediaType The type of media (movie|tv|person)
     */
    public function getTrending(string $mediaType, int $pageNum = 1, string $timeWindow = 'day')
    {
        if (isset($pageNum)) {
            $this->params['page'] = $pageNum;
        }

        return $this->call('/trending/' . $mediaType . '/' . $timeWindow);
    }

    public function getMedia(int $tmdbId)
    {
        return $this->call('/movie/' . $tmdbId);
    }
}
