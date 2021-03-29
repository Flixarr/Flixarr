<a {{$showMore ? 'href='.$showMore.'' : ''}} class="relative flex items-center justify-between">
    <span class="pr-3 bg-gray-900 text-lg font-medium capitalize">
        {!! $title !!}
    </span>

    @if($showMore)
    <div class="inline-flex items-center shadow-sm px-4 pr-0 py-1.5 text-sm leading-5 font-medium rounded-full bg-gray-900 text-gray-400">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
    @endif
</a>
