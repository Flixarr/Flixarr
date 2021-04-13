{{-- Filter Box --}}
<div class="container mx-auto px-4" x-data="filter()">
    <div class="bg-gray-800 p-4 rounded space-y-4">
        <div class="flex justify-between items-center space-x-4">
            <div class="inline-flex bg-gray-900 rounded p-1.5 w-auto justify-between tablet:gap-x-4 text-sm tablet:text-sm text-center space-x-4">
                <div x-on:click="setMediaType('movie')" :class="{ 'bg-blue-500 text-white rounded': type === 'movie' }" class="px-2 py-0.5">Movies</div>
                <div x-on:click="setMediaType('tv')" :class="{ 'bg-blue-500 text-white rounded': type === 'tv' }" class="px-2 py-0.5 whitespace-nowrap">TV Shows</div>
                <div x-on:click="setMediaType('person')" :class="{ 'bg-blue-500 text-white rounded': type === 'person' }" class="px-2 py-0.5 whitespace-nowrap">People</div>

            </div>
            <div class="flex">
                <svg x-on:click="toggleMoreFilters()" class="h-7 w-7 text-muted hover:text-white cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                </svg>
            </div>
        </div>

        <div class="flex flex-col space-y-2" x-show="isMoreFiltersOpen()">
            <div class="relative inline-block text-left text-sm" x-data="{ open: false }">
                <div>
                    <button x-on:click="open = true" type="button" class="inline-flex justify-between items-center w-full bg-gray-900 p-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" id="options-menu" aria-expanded="true" aria-haspopup="true">
                        Years: All the years

                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div x-show="open" x-on:click.away="open = false" class="z-10 origin-top absolute mt-2 w-full max-h-36 overflow-y-auto rounded shadow-lg bg-gray-900 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Account settings</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Support</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">License</a>
                    </div>
                </div>
            </div>
            <div class="relative inline-block text-left text-sm" x-data="{ open: false }">
                <div>
                    <button x-on:click="open = true" type="button" class="inline-flex justify-between items-center w-full bg-gray-900 p-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" id="options-menu" aria-expanded="true" aria-haspopup="true">
                        Years: All the years

                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div x-show="open" x-on:click.away="open = false" class="z-10 origin-top absolute mt-2 w-full max-h-36 overflow-y-auto rounded shadow-lg bg-gray-900 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Account settings</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Support</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">License</a>
                    </div>
                </div>
            </div>
            <div class="relative inline-block text-left text-sm" x-data="{ open: false }">
                <div>
                    <button x-on:click="open = true" type="button" class="inline-flex justify-between items-center w-full bg-gray-900 p-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" id="options-menu" aria-expanded="true" aria-haspopup="true">
                        Years: All the years

                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div x-show="open" x-on:click.away="open = false" class="z-10 origin-top absolute mt-2 w-full max-h-36 overflow-y-auto rounded shadow-lg bg-gray-900 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Account settings</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Support</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">License</a>
                    </div>
                </div>
            </div>
            <div class="relative inline-block text-left text-sm" x-data="{ open: false }">
                <div>
                    <button x-on:click="open = true" type="button" class="inline-flex justify-between items-center w-full bg-gray-900 p-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" id="options-menu" aria-expanded="true" aria-haspopup="true">
                        Years: All the years

                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div x-show="open" x-on:click.away="open = false" class="z-10 origin-top absolute mt-2 w-full max-h-36 overflow-y-auto rounded shadow-lg bg-gray-900 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Account settings</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Support</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">License</a>
                    </div>
                </div>
            </div>
            <div class="relative inline-block text-left text-sm" x-data="{ open: false }">
                <div>
                    <button x-on:click="open = true" type="button" class="inline-flex justify-between items-center w-full bg-gray-900 p-2 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" id="options-menu" aria-expanded="true" aria-haspopup="true">
                        Years: All the years

                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div x-show="open" x-on:click.away="open = false" class="z-10 origin-top absolute mt-2 w-full max-h-36 overflow-y-auto rounded shadow-lg bg-gray-900 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <div class="py-1" role="none">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Account settings</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Support</a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 hover:text-gray-900" role="menuitem">License</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@push('scripts')
    <script>
        function filter() {
            return {
                type: 'movie',
                showMoreFilters: true,
                setMediaType(type) {
                    this.type = type
                    @this.setMediaType(type)
                },
                toggleMoreFilters() {
                    this.showMoreFilters = !this.showMoreFilters
                },
                closeMoreFilters() {
                    this.showMoreFilters = false
                },
                isMoreFiltersOpen() {
                    return this.showMoreFilters === true
                }

            }
        }

    </script>
@endpush
