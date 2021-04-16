<div class="fixed inset-0 overflow-hidden" x-show="modalIsOpen">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-black bg-opacity-80 transition-opacity" aria-hidden="true"></div>

        <div class="absolute inset-y-0 right-0 max-w-full flex">
            <div class="relative w-screen max-w-md" x-on:click.away="close()">
                <div class="h-full flex flex-col bg-gray-900 shadow-xl overflow-y-auto">
                    <div class="absolute right-0 p-4 mix-blend-luminosity" x-on:click="close()">
                        <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    <div class="">
                        <div class="items-center justify-center w-full my-10" wire:loading.flex>
                            <x-loading size="20" />
                        </div>


                        @if ($media)
                            <div class="divide-y divide-gray-200" wire:loading.remove>

                                <div class="p-4 sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
                                    <div class="flex items-center space-x-5">
                                        <div class="flex-shrink-0">
                                            <div class="relative">
                                                <img class="h-16 w-16 rounded-full" src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80" alt="">
                                                <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <h1 class="text-2xl font-bold text-gray-900">Ricardo Cooper</h1>
                                            <p class="text-sm font-medium text-gray-500">Applied for <a href="#" class="text-gray-900">Front End Developer</a> on <time datetime="2020-08-25">August 25, 2020</time></p>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
                                        <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                                            Disqualify
                                        </button>
                                        <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                                            Advance to offer
                                        </button>
                                    </div>
                                </div>

                                <div class="pb-6 hidden">
                                    {{-- backdrop --}}
                                    <div class="bg-cover bg-center h-52 overflow-hidden bg-gray-800" style="background-image: url('https://image.tmdb.org/t/p/w500/{{ $media['backdrop_path'] }}')"></div>

                                    <div class="space-y-4">

                                        <div class="px-4 flex space-x-4">
                                            {{-- poster --}}
                                            <div class="-mt-20 w-1/3 flex-shrink-0">
                                                <div class="rounded-lg overflow-hidden bg-cover bg-center border-4 border-gray-900 shadow-xl h-60 w-full bg-gray-800" style="background-image: url('https://image.tmdb.org/t/p/w500/{{ $media['poster_path'] }}')"> </div>
                                            </div>

                                            {{-- title and data --}}
                                            <div class="py-2">
                                                <h1 class="font-bold text-2xl">{{ $media['title'] }}</h1>
                                                <h3 class="text-muted">{{ substr($media['release_date'], 0, 4) }}</h3>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function modal() {
            return {
                modalIsOpen: false,
                async openModal(tmdbId) {
                    this.modalIsOpen = true
                    @this.loadM(tmdbId)
                },
                close() {
                    this.modalIsOpen = false
                }
            }
        }

    </script>
@endpush
