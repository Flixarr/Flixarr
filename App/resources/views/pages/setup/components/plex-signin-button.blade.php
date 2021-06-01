<div class="w-full" x-data="plexSignin()">
    <x-forms.button x-show="!isLoading" x-on:click="startSignin">Sign in with Plex</x-forms.button>
    <x-loading size="8" class="mx-auto" x-show="isLoading" />
</div>

@push('scripts')
<script>
    var plexWindow
    var poll

    function plexSignin() {
        return {
            isLoading: @entangle('isLoading'),
            startSignin() {
                @this.isLoading = true;
                plexWindow = window.open('/loading')
                @this.getPlexAuthUrl().then(url => {
                    if (url) {
                        plexWindow.location = url
                        executePollToVerifyAuth()
                    }
                })
            }
        }
    }

    function executePollToVerifyAuth() {
        var signinStatus = setInterval(function() {
            if (plexWindow.closed) {
                clearInterval(signinStatus)
                @this.plexWindowClosed()
            }
            @this.validatePlexPin().then(status => {
                if (status != 'notclaimed') {
                    if (status === 'claimed') {
                        closePlexWindow()
                        @this.authCompleted()
                    }
                    clearInterval(signinStatus)
                }
            })
        }, 2000)
    }

    function closePlexWindow() {
        plexWindow.close()
        @this.isLoading = false;
    }
</script>
@endpush