<div class="w-full h-[11.5rem]" wire:init="load">
    <div class="h-full pt-4" wire:loading.remove>
        <div class="ios-padding-x">
            <div id="discover-trending-slider" class="relative" wire:ignore>
                <div class="splide__track xl:rounded-lg !overflow-hidden">
                    <ul class="splide__list flex space-x-4">

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="items-center justify-center h-full" wire:loading.flex>
        <x-loading size="16" />
    </div>
</div>
