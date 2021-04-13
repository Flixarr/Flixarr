<div class="container mx-auto px-4" wire:init="loadMedia">
    <div class="grid grid-cols-3 laptop:grid-cols-5 desktop:grid-cols-6 grid-flow-row gap-4">
        @if ($media)
            @foreach ($media as $item)
                {{-- @if ($loop->even)
                    <div class="relative">
                        <img class="object-cover rounded opacity-25" src="https://image.tmdb.org/t/p/w220_and_h330_face{{ $item['poster_path'] }}">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="h-10 w-10 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                @else --}}
                <div class="space-y-2">
                    <div>
                        <img class="rounded" src="https://image.tmdb.org/t/p/w220_and_h330_face{{ $item['poster_path'] ?? $item['profile_path'] }}" loading="lazy">
                    </div>
                    <div class="w-full text-xs space-y-1 laptop:space-y-2">
                        <div class="text-white truncate tablet:text-sm">
                            {{ $item['title'] ?? $item['name'] }}
                        </div>
                        <div class="w-full tablet:flex justify-between">
                            <div class="text-muted font-semibold">{{ Str::substr($item['release_date'] ?? ($item['first_air_date'] ?? null), 0, 4) }}</div>
                            <div class="hidden tablet:flex space-x-1">
                                <span class="bg-gray-800 text-gray-500 rounded px-1">Action</span>
                                <span class="bg-gray-800 text-gray-500 rounded px-1">Action</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}

                @if ($loop->last)
                    <div class="flex flex-col space-y-2 h-48" wire:click="loadMore()">
                        <div class="flex justify-center items-center w-full h-full rounded bg-gray-800">
                            <span class="text-muted font-semibold text-lg text-center">LOAD MORE</span>
                        </div>
                        <div class="w-full h-5"></div>
                        <div class="w-full h-4"></div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <div class="justify-center w-full" wire:loading.flex>
        <x-loading size="20" />
    </div>
</div>
