<div class="">
    <div class="flex overflow-x-scroll scroll-x hide-scroll-bar -mx-5" wire:init="loadMovieGenres" wire:loading.remove>
        <div class="flex ml-5 pr-5 space-x-4">
            @foreach($genres as $genre)
            <span class="bg-gray-800 rounded px-3 py-1 whitespace-nowrap cursor-pointer" wire:click="$emitUp('genreSelected', {{$genre['id']}})">{{$genre['name']}}</span>
            @endforeach
        </div>
    </div>

    <x-util.loading.genres wire:loading.flex />
</div>
