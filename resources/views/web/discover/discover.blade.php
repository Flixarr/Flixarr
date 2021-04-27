<x-app-layout hasTopNavigation hasBottomNavigation>
    <div class="space-y-8">
        @livewire('discover.components.trending-slider')
        @livewire('components.media.container', ['containerType' => 'grid', 'title' => 'Popular Movies', 'tmdbEndpoint' => '/movie/popular', 'moreLink' =>'/asdf'])
        @livewire('components.media.container', ['containerType' => 'grid', 'title' => 'Popular TV Shows', 'tmdbEndpoint' => '/tv/popular', 'moreLink' =>'/asdf'])
    </div>
</x-app-layout>
