<div wire:init="load" @if ($status !='completed' && $status !='requestable' ) wire:poll.keep-alive="refresh" @endif>
    {{-- <div wire:init="load"> --}}

    <div class="flex divide-x divide-gray-800 items-center justify-center">

        @if($status)

        @if($status == 'requestable')
        <button class="bg-blue-500 rounded w-full p-1 focus:outline-none" wire:loading.remove wire:target="load, request" wire:click="request">Request</button>

        @elseif($status == 'requested')
        <span class="block text-center bg-gray-800 rounded w-full p-1 animate-pulse" wire:loading.remove wire:target="load">Searching...</span>

        @elseif($status == 'downloading')
        <span class="block text-center bg-gray-800 rounded w-full p-1 animate-pulse" wire:loading.remove wire:target="load">Downloading...</span>

        @elseif($status == 'failed')
        <span class="block text-center bg-gray-800 rounded w-full p-1 animate-pulse" wire:loading.remove wire:target="load">Download failed. Searching again...</span>

        @elseif($status == 'processing')
        <span class="block text-center bg-gray-800 rounded w-full p-1 animate-pulse" wire:loading.remove wire:target="load">Processsing...</span>

        @elseif($status == 'importing')
        <span class="block text-center bg-gray-800 rounded w-full p-1 animate-pulse" wire:loading.remove wire:target="load">Importing...</span>

        @elseif($status == 'series')
        <div class="w-full">
            <table class="w-full">
                @foreach($seasons as $season)
                <tr class="space-x-4">
                    <td class="whitespace-nowrap">Season {{$season['seasonNumber']}}</td>
                    <td class="w-full pl-4">
                        <div class="w-full bg-black h-5">{{$season['statistics']['percentOfEpisodes']}}</div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        @elseif($status === 'completed')
        <div class="flex w-full">
            <div class="w-2/3 flex items-center justify-center space-x-4 p-1 text-green-500" wire:loading.remove wire:target="load">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span> Available! </span>
            </div>
            <div class="w-1/3 flex items-center justify-end space-x-6 p-1" wire:loading.remove wire:target="load">
                <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                </svg>

                <div class="relative inline-block text-left text-gray-400">
                    <div>
                        <button type="button" class="flex items-center focus:outline-none" id="options-menu" aria-expanded="true" aria-haspopup="true">
                            <span class="sr-only">Open options</span>
                            <svg class="h-6 w-6 hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="origin-top-right absolute z-10 right-0 mt-2 w-56 rounded-md shadow-lg bg-gray-800 text-sm ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <div class="py-1" role="none">
                            <a href="#" class="block px-4 py-2 hover:text-white" role="menuitem">Upgrade to 4K</a>
                            <a href="#" class="block px-4 py-2 hover:text-white" role="menuitem">View Media Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @endif
    </div>

    <div wire:loading.flex wire:target="load, request">
        <x-util.loading.spinner size="8" class="mx-auto" />
    </div>
</div>
