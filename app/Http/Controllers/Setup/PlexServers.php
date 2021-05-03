<?php

namespace App\Http\Controllers\Setup;

use App\Models\API\Plex;
use Livewire\Component;

class PlexServers extends Component
{
    // States
    public $loading = false;

    public function render()
    {
        return view('web.auth.login');
    }

    public function getPlexAuthUrl()
    {
        // Generate Auth Pin
        $this->pin = (new Plex)->authPin();

        $this->dispatchBrowserEvent('consolelog', ['data' => $this->pin]);

        // Build Auth Url
        $plexAuthUrl = (new Plex)->authUrl($this->pin['code']);

        $this->dispatchBrowserEvent('consolelog', ['data' => $plexAuthUrl]);

        return $plexAuthUrl;
    }
}
