<x-layouts.minimal title="{{$title}}">

    <div class="flex flex-col items-center space-y-2">
        <x-app.logo size="20" />
        <h1 class="text-4xl font-bold text-white uppercase">Flixarr Setup</h1>
    </div>

    <div>
        <form action="/setup/tos" method="POST">
            @csrf
            <x-panel>

                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-white uppercase">{{$title}}</h2>
                    <p>Welcome to Flixarr, your new Plex ecosystem management app! Before we continue, you need to agree to our <a href="#" class="text-white">Terms of Service</a>.</p>
                </div>

                <div class="flex items-center validation {{ ($errors->has('agree')) ? 'has-error' : ''}}">
                    <input id="agree" name="agree" type="checkbox" class="w-4 h-4 bg-gray-700 rounded text-primary focus:outline-none focus:ring-0">
                    <label for="agree" class="block ml-4">
                        I agree to the <a href="#" class="text-white">Terms of Service</a>
                    </label>
                </div>

                @if($errors->any())
                <x-alert type="error">
                    {{$errors->first()}}
                </x-alert>
                @endif

                <div>
                    <x-forms.button type="submit">Continue</x-forms.button>
                </div>

            </x-panel>
        </form>
    </div>

</x-layouts.minimal>