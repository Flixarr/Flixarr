<x-app-layout type="minimal">
    <div x-data="signIn()">
        <div class="absolute inset-0 flex items-center justify-center -mt-20">
            <div class="max-w-xs w-full space-y-10">
                <div class="text-center space-y-2">
                    <h1 class="text-white font-bold text-2xl">{{ config('app.name') }}</h1>
                    <h3 class="text-lg text-muted">Sign into your account</h3>
                </div>
                <x-box>
                    <div class="flex flex-col items-center space-y-4">
                        <span class="text-center text-muted text-xs">To get started, sign in with your Plex account.</span>
                        <div class="" x-show="!loading">
                            <button class="button text-base" x-on:click="start">Sign in with Plex</button>
                        </div>
                        <x-loading x-show="loading" style="display: none" />
                    </div>
                </x-box>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script>
        var plexWindow;
        var poll;

        function signIn() {
            return {
                loading: @entangle('loading'),
                start() {
                    @this.loading = true;
                    plexWindow = window.open('/loading');
                    @this.getPlexAuthUrl().then(url => {
                        if (url) {
                            plexWindow.location = url
                            executePoll()
                        }
                    })
                }
            }
        }

    </script>
@endpush
