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
        if (empty(config('tmdb.api_key'))) {
            abort(500, 'TMDB API Key is missing');
        }

        $this->url = 'https://api.themoviedb.org/3';
        $this->params = [
            'api_key' => config('tmdb.api_key'),
            'language' => 'en-US',
            // 'region' => 'US',
            'watch_region' => 'US',
        ];
    }

    public function call(string $endpoint)
    {
        return Http::get($this->url . $endpoint, $this->params)->json();
    }

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

    /**
     * ======================================================================================
     */

    /**
     * Discover
     */
    public function discover($mediaType, $params = [])
    {
        if (isset($params)) {
            foreach ($params as $key => $value) {
                $this->params[$key] = $value;
            }
        }

        return $this->call('/discover/' . $mediaType);
    }

    public function mediaByProvider($provider, $mediaType, $params = null)
    {
        switch ($provider) {
            case 'netflix':
                $this->params['with_watch_providers'] = 8;
                break;
            case 'hulu':
                $this->params['with_watch_providers'] = 15;
                break;
            case 'amazon':
                $this->params['with_watch_providers'] = "9,10";
                break;
            case 'disney':
                $this->params['with_watch_providers'] = "337,390";
                break;
            case 'hbo':
                $this->params['with_watch_providers'] = "118,280,31,384,425,27";
                break;
            case 'google':
                $this->params['with_watch_providers'] = 3;
                break;
            case 'youtube':
                $this->params['with_watch_providers'] = "192,188,235";
                break;
            case 'directv':
                $this->params['with_watch_providers'] = "467,358";
                break;
            case 'paramount':
                $this->params['with_watch_providers'] = 531;
                break;
            case 'vudu':
                $this->params['with_watch_providers'] = "7,332";
                break;
            case 'starz':
                $this->params['with_watch_providers'] = 43;
                break;
            case 'showtime':
                $this->params['with_watch_providers'] = 37;
                break;
            case 'cbs':
                $this->params['with_watch_providers'] = 78;
                break;
            case 'boomerang':
                $this->params['with_watch_providers'] = 248;
                break;
            case 'hallmark':
                $this->params['with_watch_providers'] = 281;
                break;
            case 'lifetime':
                $this->params['with_watch_providers'] = 284;
                break;
            case 'amc':
                $this->params['with_watch_providers'] = "528,352";
                break;
            case 'bravo':
                $this->params['with_watch_providers'] = 365;
                break;
            case 'tnt':
                $this->params['with_watch_providers'] = 363;
                break;
            case 'tru':
                $this->params['with_watch_providers'] = 507;
                break;
        }

        if (isset($params)) {
            foreach ($params as $key => $value) {
                $this->params[$key] = $value;
            }
        }

        return $this->call('/discover/' . $mediaType);
    }

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

    public function getMedia(string $tmdbId, string $mediaType)
    {
        $this->params['append_to_response'] = "credits,videos,keywords";

        return $this->call('/' . $mediaType . '/' . $tmdbId);
    }
}
