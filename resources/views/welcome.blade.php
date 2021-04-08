<x-app-layout>

    {{-- Filter Box --}}
    <div class="container mx-auto px-4">
        <div class="bg-gray-800 p-4 rounded">
            <div class="flex justify-between items-center space-x-4">

                <div class="inline-flex justify-between bg-gray-900 rounded p-1.5 w-full tablet:w-auto tablet:gap-x-4 text-sm">
                    <div class="bg-blue-500 text-white rounded px-2 py-0.5">Popular</div>
                    <div class="px-2 py-0.5">Top Rated</div>
                    <div class="px-2 py-0.5">In Theatres</div>
                </div>

                <div class="flex">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </div>

            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <div class="grid grid-cols-3 laptop:grid-cols-5 desktop:grid-cols-6 grid-flow-row gap-4">
            @php
                $media = Illuminate\Support\Facades\Http::get('https://api.themoviedb.org/3/trending/all/day?api_key=d76c66a313d7b25ccc57e2c67770bcca')->json();
                // dd($media);
            @endphp

            @foreach ($media['results'] as $item)
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
                        <img class="rounded" src="https://image.tmdb.org/t/p/w220_and_h330_face{{ $item['poster_path'] }}">
                    </div>
                    <div class="w-full text-xs space-y-1 laptop:space-y-2">
                        <div class="text-white truncate tablet:text-sm">
                            {{ $item['title'] ?? $item['name'] }}
                        </div>
                        <div class="w-full tablet:flex justify-between">
                            <div class="">{{ Str::substr($item['release_date'] ?? $item['first_air_date'], 0, 4) }}</div>
                            <div class="hidden tablet:flex space-x-1">
                                <span class="bg-gray-800 text-gray-500 rounded px-1">Action</span>
                                <span class="bg-gray-800 text-gray-500 rounded px-1">Action</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}

                @if ($loop->last)
                    <div class="w-full h-full bg-gray-800 rounded flex items-center justify-center hover:text-white cursor-pointer">
                        <span class="font-semibold text-xl text-center">LOAD MORE</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
