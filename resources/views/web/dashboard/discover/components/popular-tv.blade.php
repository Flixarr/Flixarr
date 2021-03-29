<x-section.default title="Popular TV Shows" wire:init="load">
    @livewire('web.dashboard.discover.components.genres', ['media_type' => 'tv'])

    <div>
        <x-grid.media.poster :media="$media" mediaType="tv" wire:loading.remove />
        <x-util.loading.grid.poster wire:loading.flex />
    </div>
</x-section.default>
