<a href="{{$media['media_type'] ?? $mediaType}}/{{$media['id']}}">
    <div class="relative h-40 w-72 bg-gray-800 rounded overflow-hidden bg-cover" style="background-image: url(http://image.tmdb.org/t/p/w500/{{$media['backdrop_path']}})">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent"></div>

        @if($mediaType == 'tv')
        <div class="absolute top-0 right-0 m-3">
            <span class="text-xs bg-primary-500 rounded px-1 align-top">Series</span>
        </div>
        @endif

        <div class="absolute bottom-0 p-3">
            <h1>{{$media['title'] ?? $media['name']}}</h1>
            <span class="text-gray-400 text-xs line-clamp-2">{{$media['overview']}}</span>
        </div>
    </div>
</a>
