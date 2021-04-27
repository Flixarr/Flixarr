@if ($hasTopNavigation)
    @include('layouts.navigation.top')
@endif

<div class="max-w-screen-xl w-full mx-auto {{ $hasTopNavigation ? 'pt-16' : '' }} {{ $hasBottomNavigation ? 'pb-20' : '' }}">
    {{ $slot }}
</div>

@if ($hasBottomNavigation)
    @include('layouts.navigation.bottom')
@endif
