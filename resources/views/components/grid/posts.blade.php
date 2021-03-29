<div class="flex overflow-x-scroll scroll-x hide-scroll-bar -mx-5 pb-2">
    <div class="flex flex-nowrap ml-5 pr-5 space-x-4">
        @foreach($posts as $post)
        <div class="w-60 rounded bg-gray-800 p-3">
            <h1>{{$post['title']}}</h1>
            <p class="text-sm text-gray-500 line-clamp-2">{{$post['body']}}</p>
        </div>
        @endforeach
    </div>
</div>
