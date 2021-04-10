<div x-data="{
        notifications: [],
        remove() {
            this.notifications.splice(0, 1)
        },
    }" @notify.window="console.log($event.detail); let notification = $event.detail; notifications.push(notification); setTimeout(() => { remove() }, 3500)" class="fixed inset-0 flex flex-col items-center tablet:items-end justify-end tablet:justify-start px-4 py-6 pointer-events-none space-y-4">
    <template x-for="(notification, notificationIndex) in notifications" :key="notificationIndex" hidden>
        <div class="max-w-sm w-full bg-gray-800 shadow-lg rounded-lg pointer-events-auto" x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-8 opacity-0 tablet:translate-y-0 tablet:translate-x-8" x-transition:enter-end="translate-y-0 opacity-100 tablet:translate-x-0" x-transition:leave="transform ease-out duration-300 transition" x-transition:leave-start="translate-y-0 opacity-100 tablet:translate-x-0" x-transition:leave-end="translate-y-8 opacity-0 tablet:translate-y-0 tablet:translate-x-8">
            <div class="rounded-lg shadow-xs overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg x-show="notification.type == 'success'" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <svg x-show="notification.type == 'error'" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1 pt-0.5">
                            <p x-text="notification.message" class="text-gray-300 text-sm leading-5 font-medium tracking-wide"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="remove(notification)" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
