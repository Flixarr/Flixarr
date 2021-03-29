<div class="" wire:init="load">

    <x-section.default title="Email Notification Preferences">
        <div x-data="{ toggle: @entangle('notification_download_completed') }">
            <x-form.toggle text="Download Completed" subtext="If enabled, you will receive an email when your requested media has finished downloading." />
        </div>

        {{-- <div x-data="{ toggle: @entangle('notification_download_completed') }">
            <x-form.toggle text="Daily New Content" subtext="If enabled, you will receive an email on a daily basis with a list of newly added movies and tv shows." />
        </div> --}}
    </x-section.default>

</div>
