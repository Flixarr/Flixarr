<?php

namespace App\View\Components\Media;

use Illuminate\View\Component;

class Backdrop extends Component
{
    public $media;
    public $mediaType;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($media, $mediaType = null)
    {
        $this->media = $media;
        $this->mediaType = $this->media['media_type'] ?? $mediaType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.media.backdrop');
    }
}
