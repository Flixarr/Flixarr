<x-layouts.base title="{{$title}}">
    <div class="flex flex-col h-screen overflow-y-auto no-scrollbar">
        <div {{ $attributes->merge(['class' => 'flex flex-col w-full max-w-xl py-20 mx-auto']) }}>
            <div {{ $attributes->merge(['class' => 'space-y-10']) }}>
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts.base>