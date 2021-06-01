@if($type === 'link')
<a href="{{$link}}" {{ $attributes->merge(['class' => 'w-full px-4 py-2 text-white font-semibold rounded bg-primary text-center focus:ring-1 focus:ring-white']) }}>{{$slot}}</a>
@else
<button type="{{$type}}" {{ $attributes->merge(['class' => 'w-full px-4 py-2 text-white font-semibold rounded bg-primary disabled:opacity-50 disabled:cursor-not-allowed']) }} {{$disabled ? 'disabled' : ''}}>{{$slot}}</button>
@endif