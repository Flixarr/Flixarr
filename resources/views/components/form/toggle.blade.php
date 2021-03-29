<div class="flex items-center justify-between space-x-4 text-left cursor-pointer" x-on:click="{{$toggle ?? 'toggle'}} = !{{$toggle ?? 'toggle'}}">
    <span class="flex-grow flex flex-col" id="availability-label">
        <span class="text-sm font-medium">{{$text}}</span>
        <span class="text-xs leading-normal text-gray-600">{{$subtext}}</span>
    </span>

    <button :class="{ 'bg-primary-500': {{$toggle ?? 'toggle'}}, 'bg-gray-800': !{{$toggle ?? 'toggle'}} }" type="button" class="bg-gray-800 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-1 focus:ring-primary-500" aria-pressed="false" aria-labelledby="availability-label">
        <span class="sr-only">{{$text}}</span>
        <span :class="{ 'translate-x-5 bg-white': {{$toggle ?? 'toggle'}}, 'translate-x-0 bg-gray-400': !({{$toggle ?? 'toggle'}}) }" aria-hidden="true" class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full shadow transform ring-0 transition ease-in-out duration-200"></span>
    </button>
</div>
