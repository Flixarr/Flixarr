<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?{{ rand() }}">
    @livewireStyles

    {{-- Scripts --}}
    @livewireScripts
    <script src="{{ asset('js/app.js') }}?{{ rand() }}" defer></script>


</head>

<body class="font-sans antialiased bg-gray-900 text-gray-300 tracking-wider leading-none" id="body-content" x-data="{bodyModalOpen: false}" :class="{ 'overflow-hidden' : bodyModalOpen === true }" @lockBody.window="console.log('test')">

    {{-- Responsive State Indicator --}}
    <div class="absolute top-0 bg-blue-500 text-center text-xs z-50">
        <div class="tablet:hidden">Phone</div>
        <div class="hidden tablet:block laptop:hidden">Tablet</div>
        <div class="hidden laptop:block desktop:hidden">Laptop</div>
        <div class="hidden desktop:block">Desktop</div>
    </div>

    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Content --}}
    <main class="relative">
        {{ $slot }}
    </main>

    {{-- Notifications --}}
    <x-notification />

    {{-- Script stack --}}
    @stack('scripts')

    <script>
        window.addEventListener('consolelog', event => {
            console.log(event.detail.data);
        })

        var mouseWheelEvt = function(event) {
            if (this.doScroll) {
                console.log('yes');
            } else {
                console.log('no');
            }

            // if (document.d.doScroll)
            //     document.d.doScroll(event.wheelDelta > 0 ? "left" : "right");
            // else if ((event.wheelDelta || event.detail) > 0)
            //     document.d.scrollLeft -= 10;
            // else
            //     document.d.scrollLeft += 10;

            // return false;
        }

        // document.querySelector(".scroll-h").addEventListener('mousewheel', mouseWheelEvt)

        document.querySelector(".scroll-h").addEventListener('wheel', (e) => {
            document.querySelector(".scroll-h").scrollLeft += e.deltaY;
        })

        // var scrollDivs = document.getElementsByClassName('scroll-h');
        // for (var i = 0; i < scrollDivs.length; i++) {
        //     scrollDivs[i].addEventListener("mousewheel", mouseWheelEvt);
        // }

    </script>
</body>

</html>
