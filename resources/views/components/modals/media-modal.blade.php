<div id="mediaModal" class="fixed inset-0 overflow-hidden" x-data="modal()" x-show="modalIsOpen" @modal.window="openModal($event.detail, $dispatch)">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-black bg-opacity-80 transition-opacity" aria-hidden="true"></div>

        <div class="absolute inset-y-0 right-0 max-w-full flex">
            <div class="relative w-screen max-w-md" x-on:click.away="close()">
                <div class="h-full flex flex-col bg-gray-900 shadow-xl overflow-y-auto no-scrollbar">
                    <div class="absolute right-0 p-4 mix-blend-screen z-10" x-on:click="close()">
                        <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    <div class="">
                        <div class="items-center justify-center w-full my-10" wire:loading.flex>
                            <x-loading size="20" />
                        </div>


                        @if ($media)

                            @if ($mediaType == 'movie')
                                <div class="space-y-8 pb-16" wire:loading.remove>

                                    {{-- backdrop --}}
                                    <div class="relative h-full bg-cover bg-center">
                                        @if (isset($media['backdrop_path']) || isset($media['profile_path']))
                                            <img class="bg-cover bg-center" src="https://image.tmdb.org/t/p/w500/{{ $media['backdrop_path'] ?? $media['profile_path'] }}" alt="">
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900"></div>
                                    </div>

                                    {{-- Title / Rating --}}
                                    <div class="flex justify-between space-x-6 px-4 w-full">
                                        <div class="space-y-2">
                                            {{-- Title --}}
                                            <div class="text-2xl font-bold leading-none">
                                                {{ $media['title'] ?? $media['name'] }}
                                            </div>
                                            {{-- Year & Runtime --}}
                                            <span class="flex space-x-4 text-xs text-muted">
                                                <div class="">
                                                    {{ isset($media['release_date']) ? substr($media['release_date'], 0, 4) : '' }}
                                                </div>
                                                @if (isset($media['runtime']))
                                                    <div class="flex space-x-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class=""> {{ $media['runtime'] }} mins </span>
                                                    </div>
                                                @endif
                                            </span>
                                        </div>
                                        {{-- Rating --}}
                                        <div class="text-right flex-shrink-0">
                                            <div class="text-2xl text-yellow-500 font-bold leading-none">
                                                {{ number_format($media['vote_average'], 1) }} <span class="text-xs text-muted">/ 10</span>
                                            </div>
                                            <div class="text-xs text-muted">{{ number_format($media['vote_count']) }} votes</div>
                                        </div>
                                    </div>

                                    {{-- Tagline --}}
                                    @if (isset($media['tagline']) && !empty($media['tagline']))
                                        <div class="bg-gray-800">
                                            <blockquote class="flex items-center space-x-4 p-4">
                                                <svg class="h-5 w-5 text-muted flex-shrink-0" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                                                    <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"></path>
                                                </svg>
                                                <p class="italic leading-none text-gray-400">{{ $media['tagline'] }}</p>
                                            </blockquote>
                                        </div>
                                    @endif
                                    {{-- Genres --}}
                                    @if (isset($media['genres']) && !empty($media['genres']))
                                        <div class="overflow-hidden max-w-full">
                                            <div class="flex space-x-2 overflow-x-scroll no-scrollbar px-4 text-xs">
                                                @foreach ($media['genres'] as $genre)
                                                    <span class="bg-gray-800 text-white rounded-full px-2 py-1">{{ $genre['name'] }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Overview --}}
                                    @if (isset($media['overview']) && !empty($media['overview']))
                                        <div class="px-4 space-y-1 text-sm">
                                            <h3 class="text-muted uppercase">Storyline</h3>
                                            <p class="leading-5">{{ $media['overview'] }}</p>
                                        </div>
                                    @endif

                                    {{-- Videos --}}
                                    @if (isset($media['videos']))
                                        <div class="overflow-hidden max-w-full">
                                            <div class="flex overflow-x-scroll no-scrollbar px-4">
                                                @foreach ($media['videos'] as $video)
                                                    <div class="relative flex-shrink-0 mr-4 pb-[56.25%] pt-[30px] h-52 w-{{ $loop->count > 1 ? '4/5' : 'full' }} overflow-hidden">
                                                        <iframe class="absolute top-0 left-0 w-full" width="420" height="200" src="https://www.youtube.com/embed/{{ $video['key'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                    </div>
                                                    @if ($loop->last)
                                                        <div class="p-1">&nbsp;</div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <div class="">
                                        <div class="p-4 pb-2">
                                            <h3 class="text-sm text-muted uppercase">About Film</h3>
                                        </div>
                                        <div class="bg-gray-800 px-4 py-2 text-sm">
                                            <dl class="flex flex-col space-y-2">
                                                <div class="flex justify-between">
                                                    <dt class="text-muted">Director</dt>
                                                    <dd class="">{{ $media['director']['name'] ?? 'unknown' }}</dd>
                                                </div>

                                                <div class="flex justify-between">
                                                    <dt class="text-muted">Released</dt>
                                                    <dd class="">{{ $media['release_date'] ?? 'unknown' }}</dd>
                                                </div>

                                                <div class="flex justify-between">
                                                    <dt class="text-muted">Budget</dt>
                                                    <dd class="">{{ isset($media['budget']) ? '$' . number_format($media['budget']) : 'unknown' }}</dd>
                                                </div>

                                                <div class="flex justify-between">
                                                    <dt class="text-muted">Revenue</dt>
                                                    <dd class="">{{ isset($media['revenue']) ? '$' . number_format($media['revenue']) : 'unknown' }}</dd>
                                                </div>

                                            </dl>
                                        </div>
                                    </div>

                                    {{-- Request Button --}}
                                    <div class="text-center w-full p-4 absolute bottom-0 mb-4">
                                        <button class="w-full bg-blue-500 p-2 text-white font-semibold rounded">Request</button>
                                    </div>
                                </div>
                            @endif
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
                async openModal(media, $dispatch) {
                    $dispatch('lockBody', 1)
                    this.modalIsOpen = true
                    @this.load(media.tmdbId, media.mediaType)
                },
                close($dispatch) {
                    this.modalIsOpen = false
                }
            }
        }

    </script>
@endpush
