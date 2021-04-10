<?php

namespace App\Models\API;

use App\Models\Settings;
use App\Models\User;
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
        $this->token = Settings::get('plex_authToken', false);
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

    public function call($path, $timeout = 5)
    {
        $url = $this->host . ':' . $this->port . $path;

        return $this->xml2array(Http::timeout($timeout)->get($url, $this->headers));
    }

    public function plexCall($endpoint, $params = [], $type = 'get', $isXml = false)
    {
        $url = 'https://plex.tv' . $endpoint;

        $response = Http::withHeaders($this->headers)->$type($url, $params);

        if ($isXml) {
            $response = $this->xml2array($response->body());
        }

        return $response;
    }

    protected static function xml2array($xml)
    {
        self::normalizeSimpleXML(simplexml_load_string($xml), $result);
        return $result;
    }

    protected static function normalizeSimpleXML($obj, &$result)
    {
        $data = $obj;
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $res = null;
                self::normalizeSimpleXML($value, $res);
                if (($key == '@attributes') && ($key)) {
                    $result = $res;
                } else {
                    $result[$key] = $res;
                }
            }
        } else {
            $result = $data;
        }
    }

    /**
     * Authentication
     *
     * Below are functions associated with authentication
     */

    /**
     * Returns true if existing token is valid, false if it's not
     */
    public function verifyExistingAuth()
    {
        if ($this->token) {
            $status = $this->plexCall('/api/v2/user')->status();
            return ($status === 200) ? true : false;
        }

        return false;
    }

    /**
     * Returns an auth pin
     */
    public function authPin()
    {
        return $this->plexCall('/api/v2/pins', ['strong' => 'true'], 'post')->json();
    }

    /**
     * Returns a plex signin url
     */
    public function authUrl($pinCode)
    {
        return 'https://app.plex.tv/auth#?clientID=' . $this->clientId . '&code=' . $pinCode . '&context[device][product]=' . config('app.name');
    }

    /**
     * Validates the auth pin
     */
    public function validatePin($pinId)
    {
        // $response = Http::withHeaders($this->headers)->get('https://plex.tv/api/v2/pins/' . $pinId);

        $response = $this->plexCall('/api/v2/pins/' . $pinId);

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
                'message' => 'The Auth Pin is valid and has been claimed successfully.',
                'data' => $response,
            ];
        }
    }

    /**
     * Saves the admins plex auth token
     */
    public function saveAuthToken($token)
    {
        Settings::set('plex_authToken', $token);
    }

    // public function savePlexConfig($host, $port, $scheme,)
    // {
    //     Settings::set('plex_host', $host)
    // }

    /**
     * User Data
     */

    public function userServers()
    {
        // return Http::get('https://plex.tv/devices.xml', $this->headers)->body();
        return $this->plexCall('/pms/servers.xml', [], 'get', true);
    }

    public function pingUserServers($host, $port)
    {
        $this->host = $host;
        $this->port = $port;

        return $this->call('/', 2);
    }
}
