<x-layouts.minimal title="{{$title}}">

    <div class="flex flex-col items-center space-y-2">
        <x-app.logo size="20" />
        <h1 class="text-4xl font-bold text-white uppercase">Flixarr Setup</h1>
    </div>

    <div>
        <x-panel x-data="{ showServerSection: false }" x-on:hide-server-section.window="showServerSection = false">

            <div class="space-y-2">
                <h2 class="text-xl font-bold text-white uppercase">{{$title}}</h2>
                <p>To setup your Plex server, you can sign in with Plex below or <span x-on:click="showServerSection = true" class="link" tabindex="0">setup your Plex server manually</span> without signing in.</p>
            </div>

            <div x-show="showServerSection" x-cloak x-on:manual.window="manual = !manual">
                @livewire('pages.setup.components.plex-servers')
            </div>

            @if($errors->any())
            <div class="px-4 py-2 text-white bg-red-600 rounded">
                {{$errors->first()}}
            </div>
            @endif

            <div class="flex flex-col items-center space-y-4 sm:space-y-0 sm:space-x-4 sm:flex-row">
                <div class="w-full">
                    <div x-show="!showServerSection">
                        @livewire('pages.setup.components.plex-signin-button')
                    </div>
                    <div x-show="showServerSection" x-cloak>
                        <x-forms.button type="submit" wire:click="continue">Continue</x-forms.button>
                    </div>
                </div>
                <x-forms.button class="bg-gray-700" type="link" link="{{ url()->previous() }}">Go back</x-forms.button>
            </div>
        </x-panel>
    </div>

</x-layouts.minimal>