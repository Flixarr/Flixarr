<div class="fixed inset-0 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" {{ $attributes }} x-data="modal()" x-show="isVisible" @modal.window="open($event.details)">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-black bg-opacity-80 transition-opacity" aria-hidden="true"></div>

        <div class="absolute inset-y-0 right-0 max-w-full flex">
            <div class="relative w-screen max-w-lg" x-on:click.away="close()">
                <div class="h-full flex flex-col bg-gray-900 shadow-xl overflow-y-auto">
                    <div class="absolute right-0 p-4 mix-blend-luminosity" x-on:click="close()">
                        <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                    <div class="">
                        @livewire('components.modal-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function modal() {
            return {
                isVisible: false,
                // open() {
                //     console.log('asdf');
                //     this.isVisible = true
                // },
                close() {
                    this.isVisible = false
                }
            }
        }

    </script>
@endpush
