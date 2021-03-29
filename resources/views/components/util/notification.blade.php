<div class="">
    {{-- Alert Success --}}
    <div class="fixed inset-0 flex items-start justify-center px-4 py-6 pointer-events-none z-50">
        <div x-data="{ show: false, title: false, message: false, time: false }" x-on:alert-success.window="show = true; time = $event.detail.time; title = $event.detail.title; message = $event.detail.message; setTimeout(() => show = false, ($event.detail.time ?? 5000))" x-show="show" x-description="Notification panel, show/hide based on alert state." x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="-translate-y-12 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="max-w-sm w-full bg-gray-800 shadow-xl rounded-lg pointer-events-auto ring-1 ring-gray-700 ring-opacity-75 overflow-hidden">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-10 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <p x-text="title" class="text-sm font-medium text-white"></p>
                        <p x-html="message" x-show="message" class="text-xs text-gray-400"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button x-on:click="show = false" class="bg-gray-800 rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" x-description="Heroicon name: solid/x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Error --}}
    <div class="fixed inset-0 flex items-start justify-center px-4 py-6 pointer-events-none z-50">
        <div x-data="{ show: false, title: false, message: false, time: false }" x-on:alert-error.window="show = true; time = $event.detail.time; title = $event.detail.title; message = $event.detail.message; setTimeout(() => show = false, ($event.detail.time ?? 5000))" x-show="show" x-description="Notification panel, show/hide based on alert state." x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="-translate-y-12 opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="max-w-sm w-full bg-gray-800 shadow-lg rounded-lg pointer-events-auto ring-1 ring-red-500 ring-opacity-75 overflow-hidden">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <p x-text="title" class="text-sm font-medium text-white"></p>
                        <p x-html="message" x-show="message" class="text-xs text-gray-400"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button x-on:click="show = false" class="bg-gray-800 rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" x-description="Heroicon name: solid/x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
