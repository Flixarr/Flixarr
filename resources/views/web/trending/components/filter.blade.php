{{-- Filter Box --}}
<div class="container mx-auto px-4" x-data="filter()">
    <div class="bg-gray-800 p-1.5 grid grid-cols-3 text-center gap-2 rounded">
        <div x-on:click="setMediaType('movie')" :class="{ 'bg-blue-500 text-white rounded': mediaType === 'movie' }" class="p-2 place-self-stretch">Movies</div>
        <div x-on:click="setMediaType('tv')" :class="{ 'bg-blue-500 text-white rounded': mediaType === 'tv' }" class="p-2 place-self-stretch">TV Shows</div>
        <div x-on:click="setMediaType('person')" :class="{ 'bg-blue-500 text-white rounded': mediaType === 'person' }" class="p-2 place-self-stretch">People</div>
    </div>
</div>


@push('scripts')
    <script>
        function filter() {
            return {
                mediaType: 'movie',
                showMoreFilters: true,
                setMediaType(mediaType) {
                    this.mediaType = mediaType
                    @this.setMediaType(mediaType)
                },

            }
        }

    </script>
@endpush
