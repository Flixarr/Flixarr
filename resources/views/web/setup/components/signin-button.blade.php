<div class="" x-data="plexSignin()" wire:init="verifyExistingAuth()">
    <div class="h-10" x-show="button" style="display: none">
        <button x-on:click="startSignin()" class="w-full tablet:w-auto bg-blue-500 text-white font-bold rounded px-6 py-2 focus:outline-none">
            Sign in with Plex
        </button>
    </div>
    <div class="flex justify-center">
        <div class="" x-show="loading">
            <x-loading />
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var plexWindow;
        var poll

        function plexSignin() {
            return {
                button: @entangle('showSigninButton'),
                loading: @entangle('showLoadingIcon'),
                startSignin() {
                    @this.loading(true);
                    plexWindow = window.open('/loading')
                    @this.getPlexAuthUrl().then(url => {
                        if (url) {
                            plexWindow.location = url
                            executePoll()
                        }
                    })
                }
            }
        }

        function executePoll() {
            var signinStatus = setInterval(function() {
                if (plexWindow.closed) {
                    clearInterval(signinStatus)
                    @this.plexWindowClosed()
                }
                @this.validatePlexPin().then(status => {
                    if (status != 'notclaimed') {
                        if (status === 'claimed') {
                            closePlexWindow()
                            @this.signinCompleted()
                        }
                        clearInterval(signinStatus)
                    }
                })
            }, 2000)
        }

        function closePlexWindow() {
            plexWindow.close()
        }

    </script>
@endpush
