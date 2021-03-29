<?php

return [
    'host' => env('PLEX_SERVER_IP', '127.0.0.1'),
    'port' => env('PLEX_SERVER_PORT', '32400'),
    'token' => env('PLEX_TOKEN', null),
    'username' => env('PLEX_USERNAME', null),
    'password' => env('PLEX_PASSWORD', null),
];
