<div class="" wire:init="loadServers">

    <div class="flex flex-col items-center space-y-4" wire:loading.flex wire:target="loadServers">
        <x-loading />
        <span class="text-2xl text-white animate-pulse">Loading your servers...</span>
        <span class="text-xs text-muted">This may take a while if you have a lot of servers...</span>
    </div>

    <div wire:loading.remove wire:target="loadServers" class="space-y-6">
        <div class="space-y-1" x-data="serverDropdown()">
            <div class="text-right">
                <button wire:click="loadServers" class="text-xs text-muted focus:outline-none">Refresh server list</button>
            </div>
            <div class="mt-1 relative">
                <button x-on:click="open" type="button" class="relative w-full bg-gray-900 border border-gray-900 rounded pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:border-gray-600" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                    <div class="flex items-center">
                        <div wire:loading.delay.remove wire:target="setSelectedServer" class="flex flex-col block truncate">
                            @if ($selectedServer)
                                <div class="flex items-center">
                                    @if ($selectedServer['online'])
                                        <span class="bg-green-500 flex-shrink-0 inline-block h-2 w-2 rounded-full" aria-hidden="true"></span>
                                    @else
                                        <span class="bg-gray-400 flex-shrink-0 inline-block h-2 w-2 rounded-full" aria-hidden="true"></span>
                                    @endif
                                    <div class="flex flex-col tablet:flex-row tablet:items-center tablet:space-x-2 font-normal ml-3 block truncate text-left w-full">
                                        <span class="{{ $selectedServer['online'] ? 'text-white' : '' }}">
                                            {{ $selectedServer['name'] }}
                                        </span>
                                        <span class="text-xs text-muted">
                                            {{ $selectedServer['host'] }}:{{ $selectedServer['port'] }} - {{ $selectedServer['type'] }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="flex flex-col tablet:flex-row tablet:items-center tablet:space-x-2 font-normal block truncate text-left w-full">
                                    <span class="">
                                        Enter details manually
                                    </span>
                                    <span class="text-xs text-muted tablet:mt-px">
                                        Enter your server details manually.
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-center w-full" wire:loading.delay wire:target="setSelectedServer">
                            <div class="">
                                <x-loading size="6" />
                            </div>
                        </div>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <ul x-show="isOpen()" x-on:click.away="close" class="z-20 absolute mt-1 w-full bg-gray-800 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-10 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                    <li x-on:click="clearSelectedServer()" class="cursor-default select-none relative py-2 pl-3 pr-9" role="option">
                        <div class="flex items-center" x-on:click="close">
                            <div class="flex flex-col tablet:flex-row tablet:items-center tablet:space-x-2 font-normal ml-5 block truncate text-left w-full">
                                <span class="">
                                    Enter details manually
                                </span>
                                <span class="text-xs text-muted tablet:mt-px">
                                    Enter your server details manually.
                                </span>
                            </div>
                        </div>
                        @if (!$selectedServer)
                            <span class="text-blue-500 absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </li>
                    @foreach ($servers as $server)
                        <li x-on:click="setSelectedServer('{{ $server['id'] }}', '{{ $server['type'] }}')" class="cursor-default select-none relative py-2 pl-3 pr-9" role="option">
                            <div class="flex items-center">
                                @if ($server['online'])
                                    <span class="bg-green-500 flex-shrink-0 inline-block h-2 w-2 rounded-full" aria-hidden="true"></span>
                                @else
                                    <span class="bg-gray-500 flex-shrink-0 inline-block h-2 w-2 rounded-full" aria-hidden="true"></span>
                                @endif
                                <div class="flex flex-col tablet:flex-row tablet:items-center tablet:space-x-2 font-normal ml-3 block truncate text-left text-muted w-full">
                                    <span class="{{ $server['online'] ? 'text-white' : '' }}">
                                        {{ $server['name'] }}
                                    </span>
                                    <span class="text-xs">
                                        {{ $server['scheme'] }}://{{ $server['host'] }}:{{ $server['port'] }} - {{ $server['type'] }}
                                    </span>
                                </div>
                            </div>
                            @if ($selectedServer && $selectedServer['id'] == $server['id'] && $selectedServer['type'] == $server['type'])
                                <span class="text-blue-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if (!$selectedServer)
            <div class="grid grid-cols-2 tablet:flex tablet:justify-items-stretch text-left space-y-2 tablet:space-y-0 tablet:space-x-2">
                <div class="col-span-2 tablet:col-span-1 flex-shrink-0 tablet:w-1/2">
                    <div class="flex items-center bg-gray-900 rounded border border-transparent focus-within:ring-1 focus-within:ring-gray-600 overflow-hidden {{ $errors->has('host') ? 'ring-1 ring-red-900' : '' }}">
                        <span class="pl-2 text-muted">{{ $manualServer['scheme'] }}://</span>
                        <input wire:model="manualServer.host" type="text" class="relative w-full pl-0 py-2 text-white bg-gray-900 border-0 focus:outline-none focus:border-transparent focus:ring-0" placeholder="192.168.0.100">
                    </div>
                </div>
                <div class="">
                    <input wire:model="manualServer.port" type="text" class="relative w-24 text-white py-2 bg-gray-900 border border-transparent rounded focus:outline-none focus:border-transparent focus:ring-1 focus:ring-gray-600 {{ $errors->has('port') ? 'ring-1 ring-red-900' : '' }}" placeholder="32400">
                </div>
                <div class="flex items-center justify-end w-full">
                    <div class="flex items-center" x-data="manualServerScheme()" x-on:click="$wire.toggleManualServerScheme(); $refs.switch.focus()">
                        <div class="flex flex-col mr-3 text-right">
                            <span class="">SSL</span>
                            <span class="text-xs text-muted">Use HTTPS</span>
                        </div>
                        <button type="button" class="bg-gray-900 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-0" aria-pressed="false" x-ref="switch" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'bg-blue-500': isHttps() }" aria-labelledby="annual-billing-label" :aria-pressed="isHttps.toString()">
                            <span class="sr-only">Turn on SSL</span>
                            <span aria-hidden="true" class="bg-white pointer-events-none inline-block h-5 w-5 rounded-full shadow transform ring-0 transition ease-in-out duration-200 translate-x-0" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'translate-x-5 bg-blue-100': isHttps(), 'translate-x-0 bg-gray-800': !(isHttps()) }"></span>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center space-x-6 text-gray-400">
            <div class="text-xs text-left">
                @if ($selectedServer && !$selectedServer['online'])
                    <span class="text-muted"><strong>Note:</strong> The selected server is either offline or not reachable.</span>
                @endif
            </div>

            <div class="tablet:flex justify-end">
                <div class="">
                    <div class="" wire:loading wire:target="saveServer">
                        <x-loading />
                    </div>
                    <button wire:loading.remove wire:click="saveServer" class="w-full tablet:w-auto bg-blue-500 text-white font-bold rounded px-6 py-2 focus:outline-none">Continue</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')

    <script>
        function serverDropdown() {
            return {
                show: false,
                open() {
                    this.show = true
                },
                close() {
                    this.show = false
                },
                isOpen() {
                    return this.show === true
                },
                clearSelectedServer() {
                    @this.selectedServer = null
                },
                setSelectedServer(id, type) {
                    @this.setSelectedServer(id, type)
                    this.show = false
                },
            }
        }

        function manualServerScheme() {
            return {
                https: @entangle('manualServer.scheme'),
                isHttps() {
                    return this.https === 'https'
                },
            }
        }

    </script>
@endpush
