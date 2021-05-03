<?php

namespace App\Http\Controllers\Setup;

use App\Models\API\Plex;
use Livewire\Component;

class Login extends Component
{
    public $loading = false;

    public $plexAuthPin;

    public function render()
    {
        return view('web.setup.login');
    }

    public function getPlexAuthUrl()
    {
        // Generate Auth Data
        $this->plexAuthPin = (new Plex)->authPin();

        dd($this->plexAuthPin);

        // $this->dispatchBrowserEvent('consolelog', ['data' => $this->plexAuthPin]);

        // // Build Auth Url
        // $plexAuthUrl = (new Plex)->authUrl($this->plexAuthPin['code']);

        // $this->dispatchBrowserEvent('consolelog', ['data' => $plexAuthUrl]);

        // return $plexAuthUrl;
    }
}
