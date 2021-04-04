<?php

namespace App\Models\API;

use App\Models\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Plex extends Model
{
    protected $host;
    protected $port;
    protected $token;
    protected $clientId;
    protected $headers;

    public function __construct()
    {
        $this->host = Settings::get('plex_host');
        $this->port = Settings::get('plex_port');
        $this->token = Settings::get('plex_auth_token');
        $clientId = Settings::get('plex_client_id');

        if ($clientId === null) {
            $this->clientId = Settings::set('plex_client_id', config('app.name') . '-' . config('app.version'));
        } else {
            $this->clientId = $clientId;
        }

        $this->headers = [
            'Accept' => 'application/json',
            'X-Plex-Platform' => 'Plex Web',
            'X-Plex-Platform-Version' => config('app.version'),
            'X-Plex-Provides' => 'Server',
            'X-Plex-Product' => config('app.name'),
            'X-Plex-Version' => config('app.version'),
            'X-Plex-Device' => 'Created by Marc Hershey',
            'X-Plex-Device-Name' => getenv('COMPUTERNAME'),

            'X-Plex-Client-Identifier' => $this->clientId,
            'X-Plex-Token' => $this->token,
        ];
    }

    /**
     * Authentication
     *
     * Below are functions associated with authentication
     */

    public function authPin()
    {
        return Http::withHeaders($this->headers)->post('https://plex.tv/api/v2/pins?strong=true')->json();
    }

    public function authUrl($pinCode)
    {
        return 'https://app.plex.tv/auth#?clientID=' . $this->clientId . '&code=' . $pinCode . '&context[device][product]=' . config('app.name');
    }

    public function validatePin($pinId)
    {
        $response = Http::withHeaders($this->headers)->get('https://plex.tv/api/v2/pins/' . $pinId);

        if ($response->status() === 429) {
            return [
                'status' => 'error',
                'message' => 'You have reached the limit for the Plex API. Please wait 60 seconds then try again.',
                'data' => $response->json(),
            ];
        }

        $response = json_decode($response->body(), true);

        if (!array_key_exists('authToken', $response)) {
            return [
                'status' => 'error',
                'message' => 'There was an issue with the API. Please refresh the page and try again.',
                'data' => $response,
            ];
        }

        if (!$response['authToken']) {
            return [
                'status' => 'notclaimed',
                'message' => 'The Auth Pin has yet to be claimed.',
                'data' => $response,
            ];
        }

        if ($response['authToken']) {
            return [
                'status' => 'valid',
                'message' => 'The Auth Pin is valid and has been claimed.',
                'data' => $response,
            ];
        }
    }

    public function saveAuthToken($token)
    {
        Settings::set('plex_admin_authtoken', $token);
    }
}
