<x-box title="{{ $title }}" moreLink="{{ $moreLink }}" wire:init="load">
    <div class="flex overflow-x-auto -mx-4 px-4 py-1 space-x-4 scroll-x" wire:loading.remove>
        @foreach ($media as $item)
            <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
                <img class="h-52 w-36 bg-cover" src="{{ App\Models\Api\TMDB::addImageUrl($item['poster_path']) }}" alt="">
            </div>
            @if ($loop->last)
                <div class="">&nbsp;</div>
            @endif
        @endforeach
    </div>

    <div class="overflow-x-auto -mx-4 px-4 py-1 space-x-4 scroll-x animate-pulse" wire:loading.flex>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
        <div class="min-w-max rounded-lg bg-gray-700 overflow-hidden">
            <div class="h-52 w-36"></div>
        </div>
    </div>
</x-box>
