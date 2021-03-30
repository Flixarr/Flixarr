<div class="flex h-full justify-center items-center -mt-16">
    <div class="space-y-8 text-center max-w-xs w-full">
        <div class="">
            <x-app.logo />
        </div>

        <div class="space-y-2">
            <h1 class="text-2xl font-bold">Welcome to {{ config('app.name') }}!</h1>
            <p class="text-gray-600">{!! $message !!}</p>
        </div>

        <div class="h-48">

            <div class="">
                <div class="flex flex-col items-center" x-data="plexSignin()" x-show="!plexAuthCompleted">
                    <x-form.button type="button" class="w-full" x-on:click="startPlexSignin" x-show="!plexAuthStarted">Sign in with Plex</x-form.button>
                    <x-util.loading.spinner x-show="plexAuthStarted" style="display: none" />
                </div>

            </div>

        </div>
    </div>

    <div class="absolute bottom-0 flex flex-col pb-4 w-full text-xs text-center text-gray-800">
        <p>{{ config('app.name') }} - {{ config('app.version') }}</p>
        <p>Created by Marc Hershey</p>
    </div>
</div>

@push('scripts')
    <script>
        var plexWindow;

        function plexSignin() {
            return {
                plexAuthStarted: @entangle('plexAuthStarted'),
                plexAuthCompleted: @entangle('plexAuthCompleted'),
                startPlexSignin() {
                    @this.plexAuthStarted = true;
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
