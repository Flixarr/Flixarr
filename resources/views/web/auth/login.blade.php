<div class="flex h-full justify-center items-center -mt-16" x-data="{ showPassword: @entangle('showPassword') }">
    <div class="space-y-8 text-center max-w-xs w-full">
        <div class="">
            <x-app.logo />
        </div>

        <div class="space-y-2">
            <h1 class="text-2xl font-bold">Sign into your account</h1>
            <p class="text-gray-600">{!! $message !!}</p>
        </div>

        <div class="h-48">
            <x-form.group wire:submit.prevent="{{$submitType}}" class="flex flex-col" wire:loading.remove wire:target="verifyUser, signIn, createAccount">
                <x-form.text wire:model="email" wire:click="clear_errors" placeholder="Plex Email Address" class="text-center" />
                <x-form.text x-show="showPassword" wire:model="password" wire:click="clear_errors" type="password" placeholder="Password" class="text-center" />
                <x-form.button type="submit">Sign in</x-form.button>
            </x-form.group>

            <div class="flex justify-center" wire:loading wire:target="verifyUser, signIn, createAccount">
                <x-util.loading.spinner size="20" />
            </div>

            <div class="mt-5">
                @if($errors->any())
                <p class="text-red-500">{{$errors->first()}}</p>
                @else
                <p>&nbsp;</p>
                @endif
            </div>

        </div>
    </div>

    <div class="absolute bottom-0 flex flex-col pb-4 w-full text-xs text-center text-gray-800">
        <p>{{config('app.name')}} - {{config('app.version')}}</p>
        <p>Created by Marc Hershey</p>
    </div>
</div>
