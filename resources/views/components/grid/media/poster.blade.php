<div class="flex overflow-x-scroll hide-scroll-bar -mx-5" {{$attributes}}>
    <div class="flex flex-nowrap ml-5 pr-5 space-x-4">
        @foreach($media as $item)
        <x-media.poster :media="$item" mediaType="{{$item['media_type'] ?? $mediaType}}" />
        @endforeach
    </div>
</div>
