<?php

namespace App\Http\Web\App;

use App\Models\API\Plex;
use Exception;
use Livewire\Component;

class Setup extends Component
{
    public $showPlexSigninButton;
    public $plexWindowOpen;
    public $pinId;
    public $plexAuthCompleted;

    public $plexLoadServersStarted;
    public $showPlexSetupSection;
    public $showPlexLoadServersButton;
    public $plexSetupType;
    public $plexUseSSL;
    public $plexServers = [];

    public function render()
    {
        return view('web.app.setup')->layout('layouts.auth');
    }

    public function mount()
    {
        $this->showPlexSigninButton = true;
        $this->plexWindowOpen = false;
        $this->showPlexSetupSection = false;
        $this->showPlexLoadServersButton = true;
        $this->plexSetupType = '';
        $this->plexUseSSL = false;
    }

    public function load()
    {
        // $this->verifyExistingAuth();
    }

    public function verifyExistingAuth()
    {
        if ((new Plex)->verifyExistingAuth()) {
            $this->setPlexAuthCompleted();
        }
    }

    public function getPlexAuthUrl()
    {
        if ($this->plexAuthCompleted) {
            $this->dispatchBrowserEvent('alert-success', ['title' => 'Signin Completed', 'message' => 'You have already successfully signed in with Plex.']);
            return false;
        }

        $pinData = (new Plex)->getAuthPin();

        while (!isset($pinData['id'])) {
            sleep(1);
        }

        $this->pinId = $pinData['id'];

        return (new Plex)->getAuthUrl($pinData['code']);
    }

    /**
     * This should return whether or not the validator needs to run again
     *
     * @return boolean
     */
    public function validatePlexPin()
    {
        if ($this->plexAuthCompleted) {
            $this->dispatchBrowserEvent('alert-success', ['title' => 'Signin Completed', 'message' => 'You have already successfully signed in with Plex.']);
            return false;
        }

        if (!$this->plexWindowOpen) {
            $this->dispatchBrowserEvent('alert-error', ['title' => 'Login Failed', 'message' => 'The popup was closed before completing login.']);
            return false;
        }

        $response = (new Plex)->validateAuthPin($this->pinId);

        if ($response['status'] === 'error') {
            $this->dispatchBrowserEvent('alert-error', ['title' => 'System Error', 'message' => $response['message']]);
            $this->dispatchBrowserEvent('consolelog', ['data' => $response['data']]);
            return false;
        }

        if ($response['status'] === 'invalid') {
            return true;
        }

        if ($response['status'] === 'valid') {
            (new Plex)->saveAuthToken($response['data']['authToken']);
            $this->setPlexAuthCompleted();
            return false;
        }
    }

    public function setPlexAuthCompleted()
    {
        $this->dispatchBrowserEvent('alert-success', ['title' => 'Successfully signed in!', 'message' => 'You have successfully signed in with Plex!']);

        $this->plexAuthCompleted = true;
        $this->showPlexSigninButton = false;
        $this->showPlexSetupSection = true;
    }

    public function setPlexLoadServersStarted()
    {
        $this->plexLoadServersStarted = true;
    }

    public function loadServers()
    {

        $response = (new Plex)->getServers()['Server'];

        if (array_filter($response, 'is_array')) {
            $servers = $response;
        } else {
            $servers[] = $response;
        }

        foreach ($servers as $key => $server) {
            // local server
            if (isset($server['localAddresses'])) {
                $this->plexServers[] = [
                    'name' => $server['name'],
                    'host' => $server['localAddresses'],
                    'port' => '32400',
                    'type' => 'local',
                ];
            }

            // remote server
            if (isset($server['address'])) {
                $this->plexServers[] = [
                    'name' => $server['name'],
                    'host' => $server['address'],
                    'port' => $server['port'],
                    'type' => 'remote',
                ];
            }
        }

        foreach ($this->plexServers as $key => $server) {
            try {
                $response = (new Plex)->testServer($server['host'], $server['port']);
                $this->plexServers[$key]['online'] = true;
            } catch (Exception $e) {
                $this->plexServers[$key]['online'] = false;
            }
        }

        $this->showPlexLoadServersButton = false;
        $this->plexLoadServersStarted = false;
    }

}
