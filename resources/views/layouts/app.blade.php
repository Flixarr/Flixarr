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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased bg-gray-900 text-gray-400">
    <div class="min-h-screen bg-gray-900">
        <div class="bg-blue-500 text-white text-center text-xs">
            {{-- <div class="block phone:hidden">Small Mobile</div>
            <div class="hidden phone:block tablet:hidden">Mobile</div> --}}

            <div class="tablet:hidden">Phone</div>
            <div class="hidden tablet:block laptop:hidden">Tablet</div>
            <div class="hidden laptop:block desktop:hidden">Laptop</div>
            <div class="hidden desktop:block">Desktop</div>
        </div>

        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="space-y-4 my-4">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
