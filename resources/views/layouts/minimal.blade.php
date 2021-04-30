{{-- This layout is for Auth, Setup, etc --}}

@if ($hasTopNavigation)
    @include('layouts.navigation.top')
@endif

<div class="ios-padding-bottom">
    <div class="max-w-screen-xl w-full mx-auto {{ $hasTopNavigation ? 'pt-16' : '' }} {{ $hasBottomNavigation ? 'pb-24' : '' }}">
        {{ $slot }}
    </div>
</div>

@if ($hasBottomNavigation)
    @include('layouts.navigation.bottom')
@endif
