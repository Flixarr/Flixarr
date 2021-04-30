<div class="relative inline-block group rounded-lg overflow-hidden z-10 transition duration-300 transform hover:scale-110 cursor-pointer appearance-none focus:outline-none text-left bg-gray-700">
    <div class="w-full h-full rounded-lg overflow-hidden">
        <div class="poster bg-gray-700 bg-cover transition duration-300 filter group-hover:blur-sm group-hover:brightness-25 overflow-hidden" style="background-image: url('{{ $media['poster_path'] }}')"></div>
    </div>

    <div class="absolute inset-0 p-2 transition duration-300 opacity-0 group-hover:opacity-100">
        <a href="/" class="flex flex-col justify-between w-full h-full">
            <div class="">
                <div class="flex justify-end">
                    <div class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-xs">{{ number_format($media['vote_average'], 1) }}</span>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="space-y-1 text-white whitespace-normal leading-tight text-muted">
                    <div class="text-2xs">{{ substr($media['release_date'] ?? $media['first_air_date'], 0, 4) }}</div>
                    <h1 class="text-white text-sm line-clamp-2 leading-tight">{{ $media['title'] ?? $media['name'] }}</h1>
                    <div class="text-xs line-clamp-4 leading-tight">{{ $media['overview'] }}</div>
                </div>
            </div>
        </a>
    </div>
</div>
