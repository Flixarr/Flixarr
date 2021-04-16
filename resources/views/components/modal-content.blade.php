<div class="h-full">
    <div class="items-center justify-center w-full my-10" wire:loading.flex>
        <x-loading size="20" />
    </div>


    @if ($media)
        <div class="divide-y divide-gray-200" wire:loading.remove>
            <div class="pb-6">
                {{-- backdrop --}}
                <div class="bg-cover bg-center h-52 overflow-hidden bg-gray-900" style="background-image: url('https://image.tmdb.org/t/p/w500/{{ $media['backdrop_path'] }}')"></div>

                <div class="space-y-4">

                    <div class="px-4 grid grid-cols-12 space-x-4">
                        {{-- poster --}}
                        <div class="-mt-20 col-span-4">
                            <div class="-m-1 flex">
                                <div class="inline-flex rounded-lg overflow-hidden border-4 border-gray-900 shadow-xl">
                                    <img onload="console.log('Loaded!')" class="flex-shrink-0 h-full w-full rounded" src="https://image.tmdb.org/t/p/w500/{{ $media['poster_path'] }}" alt="">
                                </div>
                            </div>
                        </div>

                        {{-- title and data --}}
                        <div class="col-span-8 py-2">
                            <h1 class="font-bold text-lg">{{ $media['title'] }}</h1>
                            <h3 class="text-muted text-sm">{{ substr($media['release_date'], 0, 4) }}</h3>
                        </div>
                    </div>

                    <div class="flex space-x-2 px-4">
                        <button class="bg-blue-500 w-full inline-flex items-center justify-center px-4 py-2 rounded font-semibold text-white focus:outline-none">
                            Request
                        </button>
                        <div class="relative text-left" x-data="{ open: false }">
                            <button x-on:click="open = true" type="button" class="bg-gray-800 h-full px-2 rounded flex items-center text-gray-400 hover:text-white focus:outline-none" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                <span class="sr-only">Open options</span>
                                <!-- Heroicon name: solid/dots-vertical -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </button>

                            <div x-show="open" x-on:click.away="open = false" class="text-gray-400 origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                    <a href="#" class="hover:text-white block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                                    <a href="#" class="hover:text-white block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
                                    <a href="#" class="hover:text-white block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day --}}
</div>
