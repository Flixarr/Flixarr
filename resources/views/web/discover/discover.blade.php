<x-app-layout hasTopNavigation hasBottomNavigation>
    <div class="space-y-8">

        @livewire('discover.components.trending-slider')
        @livewire('components.media.container', ['containerType' => 'scroll', 'title' => 'Popular Movies', 'tmdbEndpoint' => '/movie/popular', 'mediaType' => 'movie', 'moreLink' =>'/asdf'])
        @livewire('components.media.container', ['containerType' => 'srcoll', 'title' => 'Popular TV Shows', 'tmdbEndpoint' => '/tv/popular', 'mediaType' => 'tv', 'moreLink' =>'/asdf'])
        @livewire('components.media.container', ['containerType' => 'scroll', 'title' => 'What\'s good on Netflix', 'tmdbEndpoint' => '/tv/popular', 'mediaType' => 'tv', 'moreLink' =>'/asdf'])

    </div>
</x-app-layout>
