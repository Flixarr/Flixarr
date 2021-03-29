<div class="relative space-y-10 mb-10" wire:init="load">

    @if($media)
    <div class="relative -m-5 h-64">

        @if($media['backdrop_path'])
        <img class="object-cover h-full w-full" src="http://image.tmdb.org/t/p/w500/{{$media['backdrop_path']}}" alt="">
        @endif


        <div class="absolute inset-0 bg-gradient-to-t from-gray-900"></div>
        <div class="absolute inset-0 flex items-center m-5">
            <div class="flex items-end space-x-5">
                <div class="relative">
                    <x-media.poster :media="$media" />
                </div>
                <div class="mb-5">
                    <h1 class="text-xl font-medium line-clamp-2">{{$media['title'] ?? 'Unknown Title' }}</h1>
                    <span class="text-sm text-gray-400 font-medium">{!! (isset($media['release_date'])) ? substr($media['release_date'], 0,4) . ' -' : '<em>N/A</em> -' !!} {{$media['runtime']}} mins</span>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        @livewire('web.dashboard.media.components.controls', ['tmdbId' => $tmdbId, 'mediaType' => 'movie'])
    </div>

    @if($media['overview'] || $media['credits']['cast'])
    <x-section.default title="Overview">
        @if($media['overview'])
        <div class="" x-data="{ more: false }">
            <p class="text-gray-400 text-sm" x-on:click="more = !more" :class="{'line-clamp-4': more == false}">
                {{$media['overview']}}
            </p>
        </div>
        @endif

        @if($media['credits']['cast'])
        <div class="grid grid-cols-2  gap-3">
            @foreach($media['credits']['crew'] as $crew)
            <div class="">
                <div class="">{{$crew['job']}}</div>
                <div class="text-gray-400">{{$crew['name']}}</div>
            </div>
            @endforeach
        </div>
        @endif
    </x-section.default>
    @endif

    @if($media['genres'])
    <div class="">
        @livewire('web.dashboard.media.components.genres', ['genres' => $media['genres']])
    </div>
    @endif

    @if($trailerId)
    <x-section.default title="Trailer & Videos">
        <div class="relative h-0 overflow-hidden max-w-full w-full" style="padding-bottom: 56.25%">
            <iframe class="absolute top-0 left-0 w-full h-full" src='https://www.youtube.com/embed/{{$trailerId}}' frameborder='0' allowfullscreen></iframe>
        </div>
    </x-section.default>
    @endif

    @if($media['credits']['cast'])
    <x-section.default title="Cast" class="w-full">
        <x-grid.people :people="$media['credits']['cast']" />
    </x-section.default>
    @endif

    @if($media['similar_movies']['results'])
    <x-section.default title="Similar Movies">
        <x-grid.media.poster :media="$media['similar_movies']['results']" mediaType="movie" />
    </x-section.default>
    @endif

    @if($media['recommendations']['results'])
    <x-section.default title="Recommended Movies">
        <x-grid.media.poster :media="$media['recommendations']['results']" mediaType="movie" />
    </x-section.default>
    @endif

    @endif

</div>
