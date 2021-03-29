<x-section.default title="What's Trending Today" wire:init="load">
    @if($media)
    <x-grid.media.backdrop :media="$media" wire:loading.remove />
    @endif

    <x-util.loading.grid.backdrop wire:loading.flex />
</x-section.default>
