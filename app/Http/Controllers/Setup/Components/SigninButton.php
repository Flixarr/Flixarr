<?php

namespace App\Http\Controllers\Setup\Components;

use App\Models\API\Plex;
use App\Models\Settings;
use Livewire\Component;

class SigninButton extends Component
{
    // properties
    public $pin;

    // states
    public $showSigninButton;
    public $showLoadingIcon;

    public function mount()
    {
        $this->showSigninButton = false;
        $this->showLoadingIcon = true;
    }

    public function render()
    {
        return view('web.setup.components.signin-button');
    }

    public function loading($bool)
    {
        $this->showLoadingIcon = $bool;
        $this->showSigninButton = !$bool;
    }

    public function verifyExistingAuth()
    {
        $this->loading(true);

        $validAuthExists = (new Plex)->verifyExistingAuth();

        if ($validAuthExists) {
            $this->signinCompleted();
        } else {
            $this->showLoadingIcon = false;
            $this->showSigninButton = true;
        }
    }

    public function getPlexAuthUrl()
    {
        $this->loading(true);

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
            $this->loading(false);
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
        $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'The authentication window was closed. Try again.']);
    }

    public function signinCompleted()
    {
        sleep(2);
        return redirect('/setup/plex/servers');
    }
}
