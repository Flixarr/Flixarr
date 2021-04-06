<div class="" wire:init="loadServers">

    <div class="flex flex-col items-center space-y-4" wire:loading.flex wire:target="loadServers">
        <span class="text-2xl text-white animate-pulse">Loading your servers...</span>
        <span class="text-xs text-gray-600">This may take a while if you have a lot of servers...</span>
        <x-loading />
    </div>

    <div x-data="serverDropdown()" wire:loading.remove wire:target="loadServers" class="space-y-1">
        <div class="mt-1 relative">
            <button x-on:click="open" type="button" class="relative w-full bg-gray-900 border border-gray-900 rounded pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:border-gray-600 sm:text-sm" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                <div class="flex items-center">
                    <!-- On: "bg-green-400", Off: "bg-gray-200" -->
                    <div class="flex flex-col block truncate text-white">
                        @if ($selectedServer)
                            <div class="flex items-center">
                                <!-- Online: "bg-green-400", Not Online: "bg-gray-200" -->
                                @if ($selectedServer['online'])
                                    <span class="bg-green-500 flex-shrink-0 inline-block h-2 w-2 rounded-full" aria-hidden="true"></span>
                                @else
                                    <span class="bg-gray-400 flex-shrink-0 inline-block h-2 w-2 rounded-full" aria-hidden="true"></span>
                                @endif
                                <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                                <div class="flex flex-col font-normal ml-3 block truncate text-left {{ $selectedServer['online'] ? 'text-white' : 'text-gray-500' }} w-full">
                                    <span>
                                        {{ $selectedServer['name'] }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $selectedServer['host'] }}:{{ $selectedServer['port'] }} - {{ $selectedServer['type'] }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="">
                                <span>Enter details manually...</span>
                            </div>
                        @endif
                    </div>
                </div>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <!-- Heroicon name: solid/selector -->
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
            <ul x-show="isOpen()" x-on:click.away="close" class="absolute mt-1 w-full bg-gray-800 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-10 overflow-auto focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                <li x-on:click="clearSelectedServer()" class="cursor-default select-none relative py-2 pl-3 pr-9" id="listbox-option-0" role="option">
                    <div class="flex items-center">
                        <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                        <div class="flex flex-col font-normal ml-5 block truncate text-left text-white w-full">
                            <span>
                                Enter details manually...
                            </span>
                            <span class="text-xs text-gray-500">
                                {{--  --}}
                            </span>
                        </div>
                    </div>
                    @if (!$selectedServer)
                        <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                            <!-- Heroicon name: solid/check -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </li>
                @foreach ($servers as $server)
                    <li x-on:click="setSelectedServer('{{ $server['id'] }}', '{{ $server['type'] }}')" class="cursor-default select-none relative py-2 pl-3 pr-9" id="listbox-option-0" role="option">
                        <div class="flex items-center">
                            <!-- Online: "bg-green-400", Not Online: "bg-gray-200" -->
                            @if ($server['online'])
                                <span class="bg-green-500 flex-shrink-0 inline-block h-2 w-2 rounded-full" aria-hidden="true"></span>
                            @else
                                <span class="bg-gray-400 flex-shrink-0 inline-block h-2 w-2 rounded-full" aria-hidden="true"></span>
                            @endif
                            <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                            <div class="flex flex-col font-normal ml-3 block truncate text-left {{ $server['online'] ? 'text-white' : 'text-gray-500' }} w-full">
                                <span>
                                    {{ $server['name'] }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $server['host'] }}:{{ $server['port'] }} - {{ $server['type'] }}
                                </span>
                            </div>
                        </div>
                        @if ($selectedServer && $selectedServer['id'] == $server['id'] && $selectedServer['type'] == $server['type'])
                            <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                <!-- Heroicon name: solid/check -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </li>
                @endforeach
                <!-- More items... -->
            </ul>
        </div>
        <div class="text-xs text-gray-500 text-right">
            Refresh
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
                },
            }
        }

    </script>
@endpush
