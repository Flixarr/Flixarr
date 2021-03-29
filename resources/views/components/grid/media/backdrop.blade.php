<div class="flex overflow-x-scroll scroll-x hide-scroll-bar -mx-5" {{$attributes}}>
    <div class="flex flex-nowrap ml-5 pr-5 space-x-4">
        @foreach($media as $item)
        <x-media.backdrop :media="$item" mediaType="{{$item['media_type'] ?? $mediaType}}" />
        @endforeach
    </div>
</div>
