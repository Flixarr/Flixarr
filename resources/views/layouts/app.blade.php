@if ($hasTopNavigation)
    @include('layouts.navigation.top')
@endif

<div class="max-w-7xl w-full mx-auto ios-padding-bottom {{ $hasTopNavigation ? 'mt-16' : '' }} {{ $hasBottomNavigation ? 'mb-14' : '' }}">
    {{ $slot }}
</div>

@if ($hasBottomNavigation)
    @include('layouts.navigation.bottom')
@endif
