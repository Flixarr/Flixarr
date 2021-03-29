<?php

namespace App\Http\Web\User\Settings;

use App\Models\User;
use App\Models\UserSetting;
use Livewire\Component;
use Throwable;

class SettingsControler extends Component
{
    public $notification_download_completed;

    public function render()
    {
        return view('web.user.settings.settings');
    }

    public function load()
    {
        $settings = auth()->user()->settings;

        $this->notification_download_completed = boolval($settings->notification_download_completed);
    }

    public function updated($type, $value)
    {
        $settings = UserSetting::where('user_id', auth()->user()->id)->first();
        $settings->$type = $value;

        try {
            $settings->save();
        } catch (Throwable $e) {
            $this->dispatchBrowserEvent('alert-error', ['title' => 'Error #' . $e->getCode(), 'message' => $e->getMessage()]);
        }
    }
}
