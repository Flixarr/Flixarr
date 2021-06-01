<div x-data="{
    notifications: [],
    remove() {
        this.notifications.splice(0, 1)
    },
}" @notify.window="console.log(($event.detail.console == undefined) ? $event.detail : $event.detail.console); let notification = $event.detail; notifications.push(notification); setTimeout(() => { remove() }, 3500)" class="fixed inset-0 z-50 flex flex-col items-center justify-end px-4 py-6 space-y-4 pointer-events-none md:items-end md:justify-start">
    <template x-for="(notification, notificationIndex) in notifications" :key="notificationIndex" hidden>
        <div class="w-full max-w-sm bg-gray-800 rounded-lg shadow-lg pointer-events-auto" x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-8 opacity-0 md:translate-y-0 md:translate-x-8" x-transition:enter-end="translate-y-0 opacity-100 md:translate-x-0" x-transition:leave="transform ease-out duration-300 transition" x-transition:leave-start="translate-y-0 opacity-100 md:translate-x-0" x-transition:leave-end="translate-y-8 opacity-0 md:translate-y-0 md:translate-x-8">
            <div class="overflow-hidden rounded-lg shadow-xs">
                <div class="p-4" :class="{ 'border-l-4 border-green-600': notification.type == 'success', 'border-l-4 border-red-600': notification.type == 'error', 'border-l-4 border-yellow-500': notification.type == 'warning' }">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg x-show="notification.type == 'success'" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <svg x-show="notification.type == 'error'" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <svg x-show="notification.type == 'warning'" class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <svg x-show="notification.type == 'notification'" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div class="ml-3 flex-1 pt-0.5">
                            <p x-text="notification.message" class="text-sm leading-5 tracking-wide text-gray-300"></p>
                        </div>
                        <div class="flex flex-shrink-0 ml-4">
                            <button @click="remove(notification)" class="inline-flex text-gray-400 transition duration-150 ease-in-out focus:outline-none focus:text-gray-500">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
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