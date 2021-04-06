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

    public $count;

    public function mount()
    {
        $this->signinLoading = false;
        $this->count = 1;
    }

    public function render()
    {
        return view('web.setup.components.signin-button');
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

    public function validatePlexPin()
    {
        $status = (new Plex)->validatePin($this->pin['id']);

        $this->dispatchBrowserEvent('consolelog', ['data' => $status]);

        if ($status['status'] === 'error') {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'Please refresh the page and try again...']);
            return 'error';
        }

        if ($status['status'] === 'notclaimed') {
            return 'notclaimed';
        }

        if ($status['status'] === 'valid') {
            (new Plex)->saveAuthToken($status['data']['authToken']);
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Successfully connected via Plex!']);
            return 'valid';
        }
    }

    public function completeSignin()
    {
        // save plex user details

        // redirect
        return redirect('/setup/plex/servers');
    }
}
