<?php

namespace App\Http\Web\Dashboard\Media\Components;

use Livewire\Component;

class Genres extends Component
{
    public $genres;

    public function render()
    {
        return view('web.dashboard.media.components.genres');
    }

    public function mount($genres)
    {
        $this->genres = $genres;
    }
}
