<?php

namespace App\Http\Controllers\Setup\Components;

use App\Models\API\Plex;
use App\Models\PlexServer;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class LoadServers extends Component
{
    public $servers = [];
    public $selectedServer;
    public $manualServer = [];

    public function render()
    {
        return view('web.setup.components.load-servers');
    }

    public function mount()
    {
        // $servers = collect([
        //     [
        //         'id' => '68842555ca1a3940077affebf5f76125b94929d7',
        //         'name' => 'Marc\'s Media Server 1',
        //         'host' => '10.0.0.101',
        //         'port' => '32400',
        //         'scheme' => 'http',
        //         'type' => 'local',
        //         'online' => true,
        //     ],
        //     [
        //         'id' => '68842555ca1a3940077affebf5f76125b94929d7',
        //         'name' => 'Marc\'s Media Server 2 ',
        //         'host' => '74.134.17.177',
        //         'port' => '13991',
        //         'scheme' => 'http',
        //         'type' => 'remote',
        //         'online' => false,
        //     ],
        //     [
        //         'id' => 'f744ee4b68923061ffd9e8180b4db81bd718d3b6',
        //         'name' => 'Marc\'s Media Server 3',
        //         'host' => '10.0.0.101',
        //         'port' => '32400',
        //         'scheme' => 'http',
        //         'type' => 'local',
        //         'online' => true,
        //     ],
        //     [
        //         'id' => 'f744ee4b68923061ffd9e8180b4db81bd718d3b6',
        //         'name' => 'Marc\'s Media Server 4',
        //         'host' => '74.134.17.177',
        //         'port' => '16179',
        //         'scheme' => 'http',
        //         'type' => 'remote',
        //         'online' => false,
        //     ],
        // ]);

        // $this->servers = $servers->sortByDesc('online')->values();

        $this->manualServer['scheme'] = 'http';
    }

    public function loadServers()
    {
        $this->servers = [];

        $servers = (new Plex)->userOwnedServers();

        if (isset($servers['error'])) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'An issue with the Plex API occured.', 'console' => 'Plex says: ' . $servers['error']]);
            return;
        }

        if (!$servers) {
            return [];
        }

        // spilt each server into local and remote servers
        foreach ($servers as $key => $server) {
            // local server
            if (isset($server['localAddresses'])) {
                $this->servers[] = [
                    'id' => $server['machineIdentifier'],
                    'name' => $server['name'],
                    'host' => $server['localAddresses'],
                    'port' => '32400',
                    'scheme' => $server['scheme'],
                    'type' => 'local',
                ];
            }

            // remote server
            if (isset($server['address'])) {
                $this->servers[] = [
                    'id' => $server['machineIdentifier'],
                    'name' => $server['name'],
                    'host' => $server['address'],
                    'port' => $server['port'],
                    'scheme' => $server['scheme'],
                    'type' => 'remote',
                ];
            }
        }

        // check if server is online or not
        foreach ($this->servers as $key => $server) {
            $serverStatus = (new Plex)->isServerOnline($server['host'], $server['port']);
            $this->servers[$key]['online'] = $serverStatus;
        }

        $this->servers = collect($this->servers)->sortByDesc('online')->values();
    }

    public function setSelectedServer($id, $type)
    {
        $this->selectedServer = $this->servers->where('type', $type)->firstWhere('id', $id);
    }

    public function toggleManualServerScheme()
    {
        if ($this->manualServer['scheme'] === 'https') {
            $this->manualServer['scheme'] = 'http';
        } else {
            $this->manualServer['scheme'] = 'https';
        }
    }

    public function saveServer()
    {
        $server = (!$this->selectedServer) ? $this->manualServer : $this->selectedServer;

        $validator = Validator::make($server, [
            'host' => ['required', 'string', 'regex:/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$|^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/'],
            'port' => ['required', 'integer', 'min:0', 'max:65535', 'regex:/^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$/'],
            'scheme' => ['required', 'string', 'regex:(http|https)'],
            'type' => ['string', 'regex:(remote|local)'],
        ], [
            'host.regex' => 'The host must be a valid URL, Hostname, or IP Address',
        ]);

        if ($validator->fails()) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => $validator->errors()->first()]);
        }

        $validator->validate();

        $serverDetails = (new Plex)->getServerDetails($server['host'], $server['port']);

        if (!$serverDetails) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'Failed to connect to your selected Plex Server.']);
            return;
        }

        $plexServer = new PlexServer();
        $plexServer->server_id = $serverDetails['machineIdentifier'];
        $plexServer->name = $serverDetails['name'];
        $plexServer->host = $serverDetails['host'];
        $plexServer->port = $serverDetails['port'];
        $plexServer->scheme = $this->selectedServer['scheme'] ?? $this->manualServer['scheme'];

        if ($plexServer->save()) {
            Settings::set('plex_server_id', $plexServer->id);
            Settings::set('setup_plex_server_completed', 1);
            Settings::set('setup_completed', 1);
            return redirect('/');
        }
    }
}
