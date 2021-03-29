<div class="space-y-3" {{$attributes}}>
    <div class="relative">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-800"></div>
        </div>
        <x-section.inc.title title="{{$title}}" showMore="{{$showMore ?? null}}" />
    </div>

    {{$slot}}

</div>
