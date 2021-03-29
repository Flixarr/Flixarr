<x-section.default title="Popular Movies" wire:init="load">
    @livewire('web.dashboard.discover.components.genres', ['media_type' => 'movie'])

    <div>
        <x-grid.media.poster :media="$media" mediaType="movie" wire:loading.remove />
        <x-util.loading.grid.poster wire:loading.flex />
    </div>
</x-section.default>
