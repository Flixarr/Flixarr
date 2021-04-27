<x-app-layout hasTopNavigation hasBottomNavigation>
    <div class="w-full py-4">
        <div class="splide" data-splide='{"type":"loop","autoHeight":true,"autoWidth":true,"focus":"center","lazyLoad":"nearby","preloadPages":2,"autoplay":true}'>
            <div class="splide__track lg:rounded-lg overflow-hidden">
                <ul class="splide__list space-x-5">
                    <li class="splide__slide">
                        <div class="flex justify-center border border-gray-800 rounded-lg overflow-hidden">
                            <img class="h-40 lg:h-64" data-splide-lazy="{{(new App\Models\Api\TMDB)->returnRandomBackdropPath(true)}}" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="flex justify-center border border-gray-800 rounded-lg overflow-hidden">
                            <img class="h-40 lg:h-64" data-splide-lazy="{{(new App\Models\Api\TMDB)->returnRandomBackdropPath(true)}}" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="flex justify-center border border-gray-800 rounded-lg overflow-hidden">
                            <img class="h-40 lg:h-64" data-splide-lazy="{{(new App\Models\Api\TMDB)->returnRandomBackdropPath(true)}}" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="flex justify-center border border-gray-800 rounded-lg overflow-hidden">
                            <img class="h-40 lg:h-64" data-splide-lazy="{{(new App\Models\Api\TMDB)->returnRandomBackdropPath(true)}}" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="flex justify-center border border-gray-800 rounded-lg overflow-hidden">
                            <img class="h-40 lg:h-64" data-splide-lazy="{{(new App\Models\Api\TMDB)->returnRandomBackdropPath(true)}}" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="flex justify-center border border-gray-800 rounded-lg overflow-hidden">
                            <img class="h-40 lg:h-64" data-splide-lazy="{{(new App\Models\Api\TMDB)->returnRandomBackdropPath(true)}}" alt="">
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="flex justify-center border border-gray-800 rounded-lg overflow-hidden">
                            <img class="h-40 lg:h-64" data-splide-lazy="{{(new App\Models\Api\TMDB)->returnRandomBackdropPath(true)}}" alt="">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-gray-800 p-4">
        <div class="flex justify-between items-center uppercase">
            <h1 class="font-bold">Trending today</h1>
            <a href="#" class="text-2xs">See all</a>
        </div>
        <div class="">

        </div>
    </div>
</x-app-layout>
