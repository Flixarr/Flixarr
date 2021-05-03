<?php

namespace App\Models\Api;

use App\Models\PlexServer;
use App\Models\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Plex extends Model
{
    protected $host;
    protected $port;
    protected $scheme;
    protected $token;
    protected $clientId;
    protected $headers;

    public function __construct()
    {
        $plexServer = PlexServer::where('id', Settings::get('plex_server_id'))->first();

        $this->host = $plexServer['host'] ?? null;
        $this->port = $plexServer['port'] ?? null;
        $this->scheme = $plexServer['scheme'] ?? 'http';
        $this->token = Settings::get('plex_authToken') ?? null;
        $this->clientId = Settings::get('plex_client_id') ?? Settings::set('plex_client_id', config('app.name') . '-' . config('app.version'));

        $this->headers = [
            // 'Accept' => 'application/json',
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
     * ======================================================
     * UTILITIES
     * Used for general plex utilities
     * ======================================================
     */

    /**
     * a way to call to the local plex server
     *
     * todo: need to setup error handling for timeout and other
     */
    public function call(string $path, int $timeout = 5)
    {
        $url = $this->scheme . '://' . $this->host . ':' . $this->port . $path;
        return $this->xml2array(Http::timeout($timeout)->get($url, $this->headers));
    }

    /**
     * a way to call to plex.tv
     *
     * todo: need to setup error handling for timout and other
     */
    public function plexCall(string $endpoint, array $params = [], string $type = 'get', bool $isXml = false)
    {
        $url = 'https://plex.tv' . $endpoint;
        $response = Http::withHeaders($this->headers)->$type($url, $params);
        if ($isXml) {
            $response = $this->xml2array($response->body());
        }
        return $response;
    }

    /**
     * convert xml responses to arrays
     */
    protected static function xml2array($xml)
    {
        self::normalizeSimpleXML(simplexml_load_string($xml), $result);
        return $result;
    }

    /**
     * can't remember what this function does.. i just need it. -- source: unknown
     */
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
     * ======================================================
     * SETUP AND AUTHENTICATION
     * Functions below are used for setup / user authentication
     * ======================================================
     */

    /**
     * returns the plex users auth pin data
     *
     */
    public function returnAuthPinData()
    {
        return $this->plexCall('/api/v2/pins', ['strong' => 'true'], 'post', true);
    }
}
