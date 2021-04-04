<?php

namespace App\Http\Controllers\Setup\Components;

use App\Models\API\Plex;
use Livewire\Component;

class SigninButton extends Component
{
    // properties
    public $pin;

    // states
    public $signinLoading;

    public function mount()
    {
        $this->signinLoading = false;
    }

    public function render()
    {
        return view('web.setup.components.signin-button');
    }

    public function getPlexAuthUrl()
    {
        // Generate Auth Pin
        $this->pin = (new Plex)->authPin();

        // Build Auth Url
        $plexAuthUrl = (new Plex)->authUrl($this->pin['code']);

        return $plexAuthUrl;
    }

    public function validatePlexPin()
    {
        $status = (new Plex)->validatePin($this->pin['id']);

        $this->dispatchBrowserEvent('consolelog', ['data' => $status]);

        if ($status['status'] === 'error') {
            // $this->dispatchBrowserEvent('alert-error', ['title' => 'System Error', 'message' => $status['message']]);
            return 'error';
        }

        if ($status['status'] === 'notclaimed') {
            return 'notclaimed';
        }

        if ($status['status'] === 'valid') {
            (new Plex)->saveAuthToken($status['data']['authToken']);
            return 'valid';
        }
    }
}
