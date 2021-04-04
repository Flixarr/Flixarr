<x-minimal-layout>

    <div class="max-w-screen-tablet mx-auto space-y-10">
        <div class="text-center mt-28 px-4">
            <h1 class="text-2xl tablet: text-white font-bold">Welcome to Flixarr!</h1>
            <p class="text-sm text-gray-600">Your new Plex Eco-system Manamgement System</p>
        </div>

        <div class="bg-gray-800 text-center p-4 space-y-5 tablet:rounded">
            <p>To get started, sign in with your Plex account!</p>
            <div>
                @livewire('setup.components.signin-button')
            </div>
        </div>
    </div>

</x-minimal-layout>
