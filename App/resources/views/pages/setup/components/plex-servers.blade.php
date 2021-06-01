<div x-data="plex()">

    <div x-show="showAddServerButton" class="relative flex items-center justify-center border-4 border-gray-700 border-dashed rounded h-28">
        {{-- Server Section Close Button --}}
        <svg x-on:click="$dispatch('hide-server-section')" xmlns="http://www.w3.org/2000/svg" class="absolute top-0 right-0 w-5 h-5 m-2 cursor-pointer text-muted hover:text-white" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
        {{-- Add Server Button --}}
        <div class="inline-block">
            <x-forms.button class="bg-gray-700" x-on:click="$dispatch('modal')">Add Plex Server</x-forms.button>
        </div>
    </div>

    {{-- <div x-show="!showAddServerButton"> --}}
    @if($servers)
    @foreach($servers as $server)
    <div class="relative flex items-center justify-center border-4 border-gray-700 border-dashed rounded h-28">
        <div class="text-center">
            <h1 class="text-xl font-bold text-white uppercase">{{$server['name']}}</h1>
            <span class="text-gray-500">{{$server['host']}} : {{$server['port']}}</span>
        </div>
    </div>
    @endforeach
    @endif
    {{-- </div> --}}

    <x-modal title="New Plex Server" subtitle="Add a new Plex Server" class="space-y-6">
        <div class="flex space-x-2">
            <div class="w-full space-y-2">
                <x-forms.input wire:keydown.enter="addServer" wire:loading.attr="disabled" wire:target="addServer" wire:model.debounce="newServer.host" id="hostname" name="Hostname / IP Address" placeholder="{{ $_SERVER['REMOTE_ADDR'] }}" />
            </div>
            <div class="space-y-2">
                <x-forms.input wire:keydown.enter="addServer" wire:loading.attr="disabled" wire:target="addServer" wire:model.debounce="newServer.port" id="port" name="Port" placeholder="32400" />
            </div>
            <div class="flex flex-col justify-center">
                <div>&nbsp;</div>
                <div class="flex ml-2">
                    <button class="px-1" wire:click="addServer" wire:loading.remove>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button class="px-1" wire:loading wire:target="addServer">
                        <svg class="animate-spin h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </x-modal>

    @push('scripts')
    <script>
        function plex() {
            return {
                showAddServerButton: @entangle('showAddServerButton'),
            }
        }
    </script>
    @endpush

</div>