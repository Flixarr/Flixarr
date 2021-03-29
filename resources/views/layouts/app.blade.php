<!DOCTYPE html>
<html lang="en" class="bg-gray-900 text-white flex items-center justify-center">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" />

    <title>{{ (isset($page_title)) ? $page_title . ' - ' . config('app.name') : config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?{{rand()}}" />
    @livewireStyles

</head>
<body class="absolute inset-0">

    @yield('body')

    <x-util.notification />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireScripts
    @stack('scripts')

    <script>
        window.addEventListener('consolelog', event => {
            console.log(event.detail.data);
        })

    </script>

</body>
</html>
