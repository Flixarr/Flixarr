<x-layouts.minimal title="{{$title}}">

    <div class="flex flex-col items-center space-y-2">
        <x-app.logo size="20" />
        <h1 class="text-4xl font-bold text-white uppercase">Flixarr Setup</h1>
    </div>

    <div>
        <form action="/setup/database" method="POST">
            @csrf
            <x-panel>
                <div>
                    <h2 class="text-xl font-bold text-white uppercase">{{$title}}</h2>
                    <p class="text-muted">Since you are currently using Docker, we've configured a database for you so there's nothing you need to do. If you would like to use a custom database, enter those details below.</p>
                </div>

                <div class="flex items-center">
                    <input id="agree" name="agree" type="checkbox" class="w-4 h-4 bg-gray-700 rounded text-primary focus:outline-none focus:ring-0" disabled>
                    <label for="agree" class="block ml-4 text-muted">
                        I would like to use a custom database configuration
                    </label>
                </div>

                <x-alert>
                    This feature has not been enabled yet.
                </x-alert>

                <div class="flex flex-col items-center space-y-2 sm:space-y-0 sm:space-x-4 sm:flex-row">
                    <x-forms.button type="submit">Continue</x-forms.button>
                    <x-forms.button class="bg-gray-700" type="link" link="{{ url()->previous() }}">Go back</x-forms.button>
                </div>

            </x-panel>
        </form>
    </div>

</x-layouts.minimal>