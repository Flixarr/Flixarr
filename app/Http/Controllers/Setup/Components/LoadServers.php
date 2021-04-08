<?php

namespace App\Http\Controllers\Setup\Components;

use App\Models\API\Plex;
use Livewire\Component;

class LoadServers extends Component
{
    public $servers = [];
    public $selectedServer;

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
        //         'type' => 'local',
        //         'online' => true,
        //     ],
        //     [
        //         'id' => '68842555ca1a3940077affebf5f76125b94929d7',
        //         'name' => 'Marc\'s Media Server 2 ',
        //         'host' => '74.134.17.177',
        //         'port' => '13991',
        //         'type' => 'remote',
        //         'online' => false,
        //     ],
        //     [
        //         'id' => 'f744ee4b68923061ffd9e8180b4db81bd718d3b6',
        //         'name' => 'Marc\'s Media Server 3',
        //         'host' => '10.0.0.101',
        //         'port' => '32400',
        //         'type' => 'local',
        //         'online' => true,
        //     ],
        //     [
        //         'id' => 'f744ee4b68923061ffd9e8180b4db81bd718d3b6',
        //         'name' => 'Marc\'s Media Server 4',
        //         'host' => '74.134.17.177',
        //         'port' => '16179',
        //         'type' => 'remote',
        //         'online' => false,
        //     ],
        // ]);

        // $this->servers = $servers->sortByDesc('online')->values();
    }

    public function loadServers()
    {
        $this->servers = [];

        $response = (new Plex)->userServers()['Server'];

        if (array_filter($response, 'is_array')) {
            $servers = $response;
        } else {
            $servers[] = $response;
        }

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

        foreach ($this->servers as $key => $server) {
            try {
                $response = (new Plex)->pingUserServers($server['host'], $server['port']);
                $this->servers[$key]['online'] = true;
            } catch (\Exception$e) {
                $this->servers[$key]['online'] = false;
            }
        }

        $this->servers = collect($this->servers)->sortByDesc('online')->values();
    }

    public function setSelectedServer($id, $type)
    {
        $this->selectedServer = $this->servers->where('type', $type)->firstWhere('id', $id);
    }
}
