<nav class="fixed top-0 w-full bg-gray-800 z-50">
    <div class="ios-padding-x">
        <div class="max-w-screen-xl mx-auto px-2 lg:pr-4 xl:px-0">
            <div class="relative flex items-center justify-between h-16">
                {{-- Logo & Navigation Menu --}}
                <div class="flex items-center px-2 xl:px-0">
                    {{-- Logo --}}
                    <div class="flex-shrink-0">
                        <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                        <img class="hidden lg:block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow">
                    </div>
                    {{-- Navigation Menu --}}
                    <div class="hidden lg:block lg:ml-6">
                        <div class="flex space-x-4">
                            <a href="#" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">Discover</a>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Team</a>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Projects</a>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Calendar</a>
                        </div>
                    </div>
                </div>

                {{-- Search --}}
                <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-end">
                    <div class="max-w-lg w-full lg:max-w-xs">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <!-- Heroicon name: solid/search -->
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-white focus:ring-white focus:text-gray-900 text-sm" placeholder="Search..." type="search">
                        </div>
                    </div>
                </div>

                {{-- Mobile Menu Toggle --}}
                <div class="hidden flex lg:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- User --}}
                <div class="px-2 xl:px-0">
                    <div class="flex items-center">
                        {{-- User Menu --}}
                        <div class="relative flex-shrink-0" x-data="{show: false}">
                            {{-- User Menu Toggle --}}
                            <div x-on:click="show = !show">
                                <button type="button" class="bg-gray-800 rounded-full flex text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-blue-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-9 w-9 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe" alt="">
                                </button>
                            </div>

                            {{-- Desktop User Menu --}}
                            <div x-show="show" class="origin-top-right absolute right-0 mt-2 w-56 rounded leading-5 text-gray-400 shadow-lg bg-gray-800 divide-y divide-gray-700 ring-1 ring-black ring-opacity-10 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="/" class="flex flex-col px-4 py-2">
                                    <span>Signed in as</span>
                                    <span class="text-white">Marc Hershey</span>
                                </a>
                                <div class="flex flex-col px-4 py-3 space-y-2">
                                    <a href="#" class="hover:text-white">Admin Dashboard</a>
                                </div>
                                <div class="flex flex-col px-4 py-3 space-y-2">
                                    <a href="#" class="flex justify-between hover:text-white">
                                        <span>Notifications</span>
                                        <span class="flex items-center justify-center px-2 rounded-md text-2xs bg-blue-600 text-white">99+</span>
                                    </a>
                                </div>
                                <div class="flex flex-col px-4 py-3 space-y-2">
                                    <a href="#" class="hover:text-white">Your Profile</a>
                                    <a href="#" class="flex justify-between hover:text-white">
                                        <span>Your Requests</span>
                                        <span class="flex items-center justify-center px-2 rounded-md text-2xs bg-gray-700">75</span>
                                    </a>
                                    <a href="#" class="hover:text-white">Your Activity</a>
                                </div>
                                <div class="flex flex-col px-4 py-3 space-y-2">
                                    <a href="#" class="hover:text-white">Settings</a>
                                    <a href="#" class="hover:text-white text-red-600">Sign out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="hidden lg:hidden" id="mobile-menu">
            {{-- Mobile Navigation --}}
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Team</a>
                <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Projects</a>
                <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Calendar</a>
            </div>
            {{-- Mobile User Block --}}
            <div class="pt-4 pb-3 border-t border-gray-700">
                {{-- User Info --}}
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixqx=L0duSLGmaA&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-white">Tom Cook</div>
                        <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                    </div>
                    <button class="ml-auto flex-shrink-0 bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                </div>
                {{-- User Menu --}}
                <div class="mt-3 px-2 space-y-1">
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Your Profile</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Settings</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Sign out</a>
                </div>
            </div>
        </div>
    </div>
</nav>
