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

    public function verifyExistingAuth()
    {
        $response = Http::withHeaders($this->headers)->get('https://plex.tv/api/v2/user');

        if ($response->status() === 200) {
            return true;
        }

        return false;
    }

    public function getAuthPin()
    {
        return Http::withHeaders($this->headers)->post('https://plex.tv/api/v2/pins?strong=true');
    }

    public function getAuthUrl($pinCode)
    {
        return 'https://app.plex.tv/auth#?clientID=' . $this->clientId . '&code=' . $pinCode . '&context[device][product]=' . config('app.name');
    }

    /**
     * @return array with ['status'] and ['message']
     */
    public function validateAuthPin($pinId)
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

        // This has been commented out.. weird issue going on so we're just not going to check it.
        // if (array_key_exists('authToken', $response)) {
        //     return [
        //         'status' => 'error',
        //         'message' => 'There was an issue with the API. Please refresh the page and try again.',
        //         'data' => $response,
        //     ];
        // }

        if (!$response['authToken']) {
            return [
                'status' => 'invalid',
                'message' => 'The Auth Pin was either invalid or not claimed yet.',
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
        Settings::set('plex_auth_token', $token);
    }

    public function getServers()
    {
        return $this->plexCall('/pms/servers.xml');
    }

    public function testServer($host, $port)
    {
        $this->host = $host;
        $this->port = $port;

        return $this->call('/', 2);
    }

    // -----------------------------------------------------------

    public function signin()
    {
        //
    }

    public function generatePin()
    {

    }

    public function users()
    {
        $request = $this->xml2array(Http::get("https://plex.tv/api/users", $this->headers));

        return $request['User'];
    }

    public function verifyUserAccessViaId($id)
    {
        foreach ($this->users() as $plexUser) {
            if ($id == $plexUser['id']) {
                return $plexUser;
            }
        }

        return false;
    }

    public function verifyUserAccessViaEmail($email)
    {
        foreach ($this->users() as $plexUser) {
            if ($email == $plexUser['email']) {
                return $plexUser;
            }
        }

        return false;
    }

    public function getUserData($email, $password)
    {
        return Http::withHeaders([
            'X-Plex-Client-Identifier' => 'Duplexer100',
            'X-Plex-Product' => 'Duplexer',
            'X-Plex-Version' => '1.0.0',
        ])->asForm()->post('https://plex.tv/users/sign_in.json', [
            'user[login]' => $email,
            'user[password]' => $password,
        ])->json();
    }

    // ----------

    public function call($path, $timeout = 5)
    {
        $url = $this->host . ':' . $this->port . $path;

        return $this->xml2array(Http::timeout($timeout)->get($url, $this->headers));
    }

    public function plexCall($endpoint, $params = [], $type = 'get')
    {
        $url = 'https://plex.tv' . $endpoint;

        return $this->xml2array(Http::withHeaders($this->headers)->$type($url, $params));
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
}
