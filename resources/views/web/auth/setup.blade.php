<div class="flex h-full justify-center items-center -mt-16">
    <div class="space-y-8 text-center max-w-xs w-full">
        <div class="">
            <x-app.logo />
        </div>

        <div class="space-y-2">
            <h1 class="text-2xl font-bold">Profile Setup</h1>
            <p class="text-gray-600">Let's setup your new profile!</p>
        </div>



        <x-form.group wire:submit.prevent="submit" class="block h-48">
            <div class="grid grid-cols-2 gap-4">
                <x-form.text wire:model="firstName" class="text-center capitalize" placeholder="First Name" />
                <x-form.text wire:model="lastName" class="text-center capitalize" placeholder="Last Name" />
            </div>

            <div x-data="{ toggle: @entangle('requirePassword') }">
                <x-form.toggle text="Require Password on Sign in" subtext="If enabled, you will be required to enter your password to sign in." />
            </div>

            <x-form.button type="submit" class="w-full">Continue</x-form.button>

        </x-form.group>

    </div>

    <div class="absolute bottom-0 flex flex-col pb-4 w-full text-xs text-center text-gray-800">
        <p>{{config('app.name')}} - {{config('app.version')}}</p>
        <p>Created by Marc Hershey</p>
    </div>
</div>
