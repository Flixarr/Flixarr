<div class="flex overflow-x-scroll scroll-x hide-scroll-bar -mx-5" {{$attributes}}>
    <div class="flex ml-5 pr-5 space-x-4">
        @foreach($genres as $genre)
        <span class="bg-gray-800 rounded px-3 py-1 whitespace-nowrap ">{{$genre['name']}}</span>
        @endforeach
    </div>
</div>
