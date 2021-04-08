<div class="h-10" x-data="plexSignin()">

    <button x-on:click="startSignin()" x-show="!signinLoading" class="w-full tablet:w-auto bg-blue-500 text-white font-bold rounded px-6 py-2 focus:outline-none">
        Sign in with Plex
    </button>
    <div class="flex justify-center" x-show="signinLoading" style="display: none">
        <x-loading />
    </div>
</div>

@push('scripts')
    <script>
        var plexWindow;
        var poll

        function plexSignin() {
            return {
                signinLoading: @entangle('signinLoading'),

                startSignin() {
                    @this.signinLoading = true;

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
                    @this.signinLoading = false
                }

                @this.validatePlexPin().then(status => {
                    if (status != 'notclaimed') {
                        if (status === 'error') {
                            alert("There was an error. Try again.")
                        }

                        if (status === 'valid') {
                            closePlexWindow()
                            @this.completeSignin()
                        }
                        clearInterval(signinStatus)
                    }
                })

            }, 2000)
        }

        function closePlexWindow() {
            @this.signinLoading = false
            plexWindow.close()
        }

    </script>
@endpush
