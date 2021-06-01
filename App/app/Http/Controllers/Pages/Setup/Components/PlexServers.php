<?php

namespace App\Http\Controllers\Pages\Setup\Components;

use App\Models\API\Plex;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class PlexServers extends Component
{
    // properties
    public $newServer = [];
    public $servers = [];

    // states
    public $showAddServerButton = true;

    protected $listeners = ['updateServers'];

    public function render()
    {
        return view('pages.setup.components.plex-servers');
    }

    public function mount()
    {
        // $this->server = [
        //     "name" => "Marc's Media Server",
        //     "host" => "10.0.0.101",
        //     "address" => "10.0.0.101",
        //     "port" => "32400",
        //     "machineIdentifier" => "f744ee4b68923061ffd9e8180b4db81bd718d3b6",
        //     "version" => "1.22.3.4523-d0ce30438",
        // ];
    }

    public function updated()
    {
        $this->resetValidation();
    }

    public function addServer()
    {
        $validator = Validator::make($this->newServer, [
            'host' => ['required', 'string', 'regex:/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$|^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/'],
            'port' => ['required', 'integer', 'min:1', 'max:65535', 'regex:/^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$/'],
        ], [
            'host.required' => 'Hostname / IP is required.',
            'host.string' => 'Invalid Hostname / IP.',
            'host.regex' => 'Invalid Hostname / IP.',
            'port.required' => 'A Port Number is required.',
            'port.integer' => 'Invalid Port Number.',
            'port.min' => 'Invalid Port Number.',
            'port.max' => 'Invalid Port Number.',
            'port.regex' => 'Invalid Port Number.',
        ]);

        if ($validator->fails()) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => $validator->errors()->first()]);
        }

        $validator->validate();

        if ($newServerDetails = (new Plex)->getServerDetails($this->newServer['host'], $this->newServer['port'])) {
            $this->servers = $newServerDetails;
            $this->newServer = [];
            $this->showAddServerButton = false;
            $this->dispatchBrowserEvent('modal-close');
        } else {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'That server is either offline or unreachable.']);
        }
    }

    public function updateServers($servers)
    {
        $this->servers = $servers;
        $this->showAddServerButton = false;
    }
}
