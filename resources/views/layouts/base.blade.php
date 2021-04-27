<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?{{ rand() }}">
    @livewireStyles

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}?{{ rand() }}" defer></script>
    @livewireScripts
</head>

<body class="bg-gray-900 text-gray-300 text-sm tracking-wider leading-none font-sans w-full">
    {{-- Responsive State Indicator --}}

    {{ $slot }}
    <div class="fixed bottom-0 bg-blue-500 text-xs z-50 uppercase p-2">
        <div class="sm:hidden">xs</div>
        <div class="hidden sm:block md:hidden">sm</div>
        <div class="hidden md:block lg:hidden">md</div>
        <div class="hidden lg:block xl:hidden">lg</div>
        <div class="hidden xl:block">xl</div>
    </div>
</body>

@stack('scripts')

</html>
