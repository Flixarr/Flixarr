{{-- Filter Box --}}
<div class="container mx-auto px-4" x-data="filter()">
    <div class="bg-gray-800 p-1.5 grid grid-cols-3 text-center gap-2 rounded">
        <div x-on:click="setMediaType('movie')" :class="{ 'bg-blue-500 text-white rounded': type === 'movie' }" class="px-2 py-0.5 place-self-stretch">Movies</div>
        <div x-on:click="setMediaType('tv')" :class="{ 'bg-blue-500 text-white rounded': type === 'tv' }" class="px-2 py-0.5 place-self-stretch">TV Shows</div>
        <div x-on:click="setMediaType('person')" :class="{ 'bg-blue-500 text-white rounded': type === 'person' }" class="px-2 py-0.5 place-self-stretch">People</div>
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

            }
        }

    </script>
@endpush
