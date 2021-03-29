@extends('layouts.app')

@section('body')
<div>

    <nav class="hidden bg-gray-800 border-b border-black border-opacity-50" x-data="{ mobileMenu: false, userMenu: false }">
        <div class="max-w-4xl mx-auto px-2 sm:px-5">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/">
                            <x-app.logo size="9" />
                        </a>
                    </div>
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="{{route('dashboard.index')}}" class="{{ request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium">Home</a>
                            <a href="{{route('dashboard.discover')}}" class="{{ request()->is('discover*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium">Discover</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="ml-3 relative" x-on:click.away="userMenu = false">
                        <div x-on:click="userMenu = !userMenu">
                            <button class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="rounded-full h-9 w-9" src="https://ui-avatars.com/api/?name={{auth()->user()->first_name}}+{{auth()->user()->last_name}}&background=3b82f6&color=ffffff" alt="">
                            </button>
                        </div>
                        <div x-show="userMenu" class="origin-top-right absolute right-0 z-20 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-800 text-gray-400 text-sm ring-1 ring-black ring-opacity-20" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <a href="#" class="block px-4 py-2 hover:text-white" role="menuitem">Your Profile</a>
                            <a href="/user/settings" class="block px-4 py-2 hover:text-white" role="menuitem">Settings</a>
                            <a href="/logout" class="block px-4 py-2 text-red-500 hover:text-white" role="menuitem">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden h-full" x-show="mobileMenu" x-on:click.away="mobileMenu = false">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{route('dashboard.index')}}" class="{{ request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">Home</a>
                <a href="{{route('dashboard.discover')}}" class="{{ request()->is('discover*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">Discover</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto p-5 pb-16">
        {{$slot}}
    </div>

    <nav class="fixed bottom-0 w-full bg-gray-800 text-gray-500 safe-bottom">
        <div class="flex justify-evenly">
            <a href="/" class="flex flex-col items-center {{ request()->is('/') ? 'text-white' : 'hover:text-white' }} p-2">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-xs font-medium">Home</span>
            </a>
            <a href="/discover" class="flex flex-col items-center {{ request()->is('discover') ? 'text-white' : 'hover:text-white' }} p-2">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                <span class="text-xs font-medium">Discover</span>
            </a>
            <a href="/search" class="flex flex-col items-center {{ request()->is('search') ? 'text-white' : 'hover:text-white' }} p-2">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span class="text-xs font-medium">Search</span>
            </a>
            <a href="#" class="flex flex-col items-center p-2" x-on:click="mobileMenu = !mobileMenu">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span class="text-xs font-medium">More</span>
            </a>
        </div>
    </nav>
</div>
@endsection
