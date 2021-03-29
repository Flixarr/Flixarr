@props(['color' => 'primary'])

<button {{ $attributes->merge(['class' => 'bg-'.$color.'-600 rounded p-2 font-medium focus:outline-none active:bg-'.$color.'-700', 'type' => 'button']) }}>
    {{ $slot }}
</button>
