<a href="/{{$media['media_type'] ?? $mediaType}}/{{$media['id']}}">
    <div class="relative w-32 h-48 rounded overflow-hidden bg-gray-800">
        <img class="absolute inset-0 bg-cover" src="{{ isset($media['poster_path']) ? 'http://image.tmdb.org/t/p/w500'. $media['poster_path'] : ''}}" alt="">
    </div>
</a>
