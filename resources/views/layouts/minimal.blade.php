<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?{{ rand() }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased bg-gray-900 text-white">
    <div class="absolute inset-0 bg-gray-900">

        {{-- Responsive State Indicator --}}
        <div class="absolute top-0 bg-blue-500 text-center text-xs">
            <div class="tablet:hidden">Phone</div>
            <div class="hidden tablet:block laptop:hidden">Tablet</div>
            <div class="hidden laptop:block desktop:hidden">Laptop</div>
            <div class="hidden desktop:block">Desktop</div>
        </div>

        {{-- Page Content --}}
        <main class="space-y-4 my-4">
            {{ $slot }}
        </main>
    </div>

    <x-notification />

    {{-- Livewire Scripts --}}
    @livewireScripts

    {{-- Script stack --}}
    @stack('scripts')

    <script>
        window.addEventListener('consolelog', event => {
            console.log(event.detail.data);
        })

    </script>
</body>

</html>
