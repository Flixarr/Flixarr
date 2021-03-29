<div class="flex overflow-x-scroll scroll-x hide-scroll-bar -mx-5" {{$attributes}}>
    <div class="flex flex-nowrap ml-5 pr-5 space-x-4">
        @foreach($people as $person)
        <a href="/person/{{$person['id']}}">
            <div class="relative w-32 h-48 rounded overflow-hidden bg-gray-800">
                <img class="absolute inset-0 bg-cover" src="{{ isset($person['profile_path']) ? 'http://image.tmdb.org/t/p/w500'. $person['profile_path'] : ''}}" alt="">
            </div>
            <div class="text-center leading-3">
                <h1 class="text-sm">{{$person['name']}}</h1>
                <span class="text-gray-400 text-xs">{{$person['character']}}</span>
            </div>
        </a>
        @endforeach
    </div>
</div>
