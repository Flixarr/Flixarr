<div class="bg-gray-800 p-4 space-y-4 my-4 xl:rounded-lg" {{ $attributes }}>
    <div class="ios-padding-x">
        <div class="flex justify-between items-start uppercase">
            <h1 class="font-bold">{!! $title !!}</h1>
            @if ($moreLink)
                <a class="flex items-center space-x-1 text-gray-500 text-2xs" href="/{{ $moreLink }}">
                    <span>See all</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @endif
        </div>
    </div>

    <div class="">
        {{ $slot }}
    </div>
</div>
