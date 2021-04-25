<div class="space-y-4" wire:init="loadNetflixTv">
    <div class="px-4">
        <h1>Popular TV Shows on Netflix</h1>
    </div>

    <div class="" x-data="loadNetflixTv()">

        <div class="flex overflow-x-scroll no-scrollbar scroll-x" wire:loading.remove>
            <div class="flex flex-nowrap ml-4 pr-4 space-x-4">
                @if ($netflixMedia)
                    @foreach ($netflixMedia as $media)
                        <div class="relative pr-4 w-32 h-48 rounded overflow-hidden bg-gray-800">
                            {{-- <img x-on:click="$dispatch('modal', { tmdbId: tmdbId, mediaType: mediaType })" class="absolute inset-0 bg-cover" src="{{ isset($media['poster_path']) ? 'http://image.tmdb.org/t/p/w500' . $media['poster_path'] : '' }}" alt=""> --}}
                            <img x-on:click="openModal($dispatch, '{{ $media['id'] }}', 'movie')" class="absolute inset-0 bg-cover" src="{{ isset($media['poster_path']) ? 'http://image.tmdb.org/t/p/w500' . $media['poster_path'] : '' }}" alt="">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="flex overflow-x-scroll no-scrollbar" wire:loading>
            <div class="flex flex-nowrap ml-4 pr-4 space-x-4 animate-pulse">
                <div class="w-32 h-48 rounded bg-gray-800"></div>
                <div class="w-32 h-48 rounded bg-gray-800"></div>
                <div class="w-32 h-48 rounded bg-gray-800"></div>
                <div class="w-32 h-48 rounded bg-gray-800"></div>
                <div class="w-32 h-48 rounded bg-gray-800"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function loadNetflixTv() {
            return {
                openModal($dispatch, tmdbId, mediaType) {
                    $dispatch('modal', {
                        tmdbId: tmdbId,
                        mediaType: mediaType
                    })
                }
            }
        }

    </script>
@endpush
