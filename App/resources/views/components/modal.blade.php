<div class="absolute inset-0 z-10 flex overflow-hidden bg-black bg-opacity-75" x-data="{modal: false}" x-show="modal" x-on:modal.window="modal = true" x-on:modal-close.window="modal = false;" x-on:click.self="modal = false">
    <div class="flex items-end self-center justify-center w-full h-full overflow-hidden sm:items-center sm:p-8">
        <div class="flex flex-col w-full max-w-xl overflow-hidden bg-gray-800 sm:rounded max-h-3/4">
            <div class="relative p-5 mb-5 overflow-y-auto sm:mb-0 no-scrollbar">
                <div class="absolute top-0 right-0 p-5 group" x-on:click="modal = false">
                    <svg tabindex="0" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 cursor-pointer group-hover:text-white" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>

                <div class="mb-5">
                    @if($title)
                    <h1 class="text-xl font-bold text-white uppercase">{{$title}}</h1>
                    @endif
                    @if($subtitle)
                    <p>{{$subtitle}}</p>
                    @endif
                </div>

                <div {{$attributes}}>
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</div>