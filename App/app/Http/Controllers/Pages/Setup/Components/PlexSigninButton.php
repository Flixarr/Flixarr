<?php

namespace App\Http\Controllers\Pages\Setup\Components;

use App\Models\API\Plex;
use App\Models\Settings;
use Livewire\Component;


class PlexSigninButton extends Component
{
    // properties
    public $pin;

    // states
    public $isLoading;

    public function render()
    {
        return view('pages.setup.components.plex-signin-button');
    }

    public function getPlexAuthUrl()
    {
        // Generate Auth Pin
        $this->pin = (new Plex)->authPin();

        // Build Auth Url
        $plexAuthUrl = (new Plex)->authUrl($this->pin['code']);

        return $plexAuthUrl;
    }

    /**
     * Checks if user has claimed the Plex Pin
     */
    public function validatePlexPin()
    {
        $status = (new Plex)->validatePin($this->pin['id']);

        if ($status['status'] === 'error') {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'Please refresh the page and try again...']);
            $this->isLoading = false;
            return 'error';
        }

        if ($status['status'] === 'notclaimed') {
            return 'notclaimed';
        }

        if ($status['status'] === 'claimed') {
            Settings::set('plex_authToken', $status['data']['authToken']);
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Successfully signed in!']);
            return 'claimed';
        }
    }

    public function plexWindowClosed()
    {
        $this->isLoading = false;
        $this->dispatchBrowserEvent('notify', ['type' => 'warning', 'message' => 'Signin was cancelled because the window was closed.']);
    }

    public function authCompleted()
    {
        $userServers = (new Plex)->getUserOwnedServer();
        $this->emit('updateServers', $userServers);
    }
}
