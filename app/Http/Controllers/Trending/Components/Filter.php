<?php

namespace App\Http\Controllers\Trending\Components;

use Livewire\Component;

class Filter extends Component
{
    public function render()
    {
        return view('web.trending.components.filter');
    }

    public function setMediaType($mediaType)
    {
        $this->emit('setMediaType', $mediaType);
    }
}
