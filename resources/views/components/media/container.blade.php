<x-box title="{{ $title }}" moreLink="{{ $moreLink }}" wire:init="load">
    <div wire:loading.remove>
        <div class="relative scroll-x px-4 -my-4 py-4 space-x-2">
            @foreach ($media as $item)
                @livewire('components.media.poster', ['tmdbId' => $item['id'], 'mediaType' => $mediaType])
                {{-- <x-media.poster tmdbId="{{ $item['id'] }}" mediaType="{{ $mediaType }}" /> --}}
            @endforeach
        </div>
    </div>


    <div wire:loading.flex>
        <div class="relative scroll-x px-4 space-x-2 animate-pulse">
            <div class="inline-block poster bg-gray-700 rounded-lg"></div>
            <div class="inline-block poster bg-gray-700 rounded-lg"></div>
            <div class="inline-block poster bg-gray-700 rounded-lg"></div>
            <div class="inline-block poster bg-gray-700 rounded-lg"></div>
            <div class="inline-block poster bg-gray-700 rounded-lg"></div>
            <div class="inline-block poster bg-gray-700 rounded-lg"></div>
            <div class="inline-block poster bg-gray-700 rounded-lg"></div>
            <div class="inline-block poster bg-gray-700 rounded-lg"></div>
            <div class="inline-block poster bg-gray-700 rounded-lg"></div>
        </div>
    </div>
</x-box>
