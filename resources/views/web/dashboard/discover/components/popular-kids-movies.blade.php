<x-section.default title="Popular Movies for kiddos" wire:init="load">
    @if($media)
    <x-grid.media.poster :media="$media" mediaType="movie" wire:loading.remove />
    @endif

    <x-util.loading.grid.poster wire:loading.flex />
</x-section.default>
