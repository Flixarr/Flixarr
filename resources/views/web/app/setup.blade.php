<div class="flex h-full justify-center items-center py-16" wire:init="load">
    <div class="space-y-8 text-center max-w-xs w-full">
        <div class="">
            <x-app.logo />
        </div>

        <div class="space-y-2">
            <h1 class="text-2xl font-bold">Welcome to {{config('app.name')}}</h1>
            <p class="text-gray-600">Let's setup your new application!</p>
        </div>

        <x-section.default title="Plex Setup" x-data="plexSetup()">
            <div class="" x-show="showPlexSigninButton">
                <x-form.button type="button" class="w-full" x-on:click="startPlexSignin" wire:loading.remove wire:target="verifyExistingAuth">Sign in with Plex</x-form.button>
                <x-form.button type="button" class="w-full" wire:loading>Sign in with Plex</x-form.button>
            </div>
            <div class="space-y-4 relative" x-show="showPlexSetupSection">
                <x-form.button type="button" class="w-full" wire:click="loadServers" x-show="showPlexLoadServersButton">Load Servers</x-form.button>

                <fieldset class="block">
                    <legend class="sr-only">
                        Select a server
                    </legend>

                    <div class="bg-gray-900 rounded space-y-4 text-left">
                        <div class=" border border-gray-900 flex w-full" x-on:click="plexSetupType = 'manual'">
                            <div class="flex items-center h-5 mt-1">
                                <input id="test" name="servers" type="radio" class="h-4 w-4 text-primary-500 cursor-pointer border-gray-700 bg-gray-800 focus:ring-gray-900 focus:ring-offset-gray-900">
                            </div>
                            <label for="test" class="ml-3 flex flex-col cursor-pointer w-full">
                                <span class="block font-medium">
                                    Enter server details manually
                                </span>
                            </label>
                        </div>

                        @foreach($plexServers as $key => $server)
                        <div class="border border-gray-900 flex w-full" @if($server['online']) x-on:click="plexSetupType = ''" @endif>
                            <div class="flex items-center h-5 mt-1">
                                <input id="server-{{$key}}" name="servers" type="radio" class="h-4 w-4 text-primary-500 cursor-pointer border-gray-700 bg-gray-800 focus:ring-gray-900 focus:ring-offset-gray-900" {{ $server['online'] ? '' : 'disabled' }}>
                            </div>
                            <label for="server-{{$key}}" class="ml-3 flex flex-col cursor-pointer w-full">
                                <div class="flex items-center space-x-2 font-medium">
                                    @if($server['online'])
                                    <span class="bg-green-700 h-2 w-2 rounded-full mt-1"></span>
                                    @else
                                    <span class="bg-red-700 h-2 w-2 rounded-full mt-1"></span>
                                    @endif
                                    <span class="{{ $server['online'] ? 'text-white' : 'text-gray-500' }}"> {{$server['name']}} </span>
                                </div>
                                <span class="block text-gray-600 text-sm">{{$server['host']}}:{{$server['port']}} [{{$server['type']}}]</span>
                            </label>
                        </div>
                        @endforeach

                    </div>
                </fieldset>

                <div class="text-left space-y-4" x-show="plexSetupType == 'manual'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-3 " x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in-out  duration-100" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-3">
                    <hr class="border-gray-800">
                    <div>
                        <div class="mt-1">
                            <input type="text" name="email" id="email" class="block w-full sm:text-sm bg-gray-800 border-gray-700 rounded" placeholder="Hostname / IP Address" aria-describedby="email-description">
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="">
                            <div class="mt-1">
                                <input type="text" name="email" id="email" class="block w-24 sm:text-sm bg-gray-800 border-gray-700 rounded" placeholder="Port" aria-describedby="email-description">
                            </div>
                        </div>
                        <div class="">
                            <x-form.toggle text="Use SSL" subtext="" />
                        </div>
                    </div>
                </div>
            </div>
        </x-section.default>

        <x-section.default title="Radarr Settings" x-data="">

        </x-section.default>

        <x-section.default title="Sonarr Settings">

        </x-section.default>

        <div class="flex flex-col pb-4 w-full text-xs text-center text-gray-800">
            <p>{{config('app.name')}} - {{config('app.version')}}</p>
            <p>Created by Marc Hershey</p>
        </div>

    </div>

</div>

@push('scripts')
<script>
    var plexWindow;

    function plexSetup() {
        return {
            showPlexSigninButton: @entangle('showPlexSigninButton')
            , showPlexSetupSection: @entangle('showPlexSetupSection')
            , showPlexLoadServersButton: @entangle('showPlexLoadServersButton')
            , plexSetupType: @entangle('plexSetupType')
            , toggle: @entangle('plexUseSSL')
            , startPlexSignin() {
                plexWindow = window.open('/loading', '_blank');
                setPlexSigninWindowOpened();

                @this.getPlexAuthUrl().then(url => {
                    if (url) {
                        plexWindow.location = url;
                        executePoll();
                    }
                })
            }
        }
    }

    function executePoll() {
        @this.validatePlexPin().then(shouldValidateAgain => {
            if (shouldValidateAgain) {
                setTimeout(this.executePoll(), 1000)
            } else {
                closePlexWindow();
            }
        })
    }

    function setPlexSigninWindowOpened() {
        @this.plexWindowOpen = true;

        var plexWindowStatus = setInterval(function() {
            if (plexWindow.closed) {
                closePlexWindow();
                clearInterval(plexWindowStatus);
            }
        }, 1000);
    }

    function closePlexWindow() {
        plexWindow.close();
        @this.plexWindowOpen = false;
    }

</script>
@endpush
