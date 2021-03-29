<?php

namespace App\View\Components\Grid\Media;

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
        $this->mediaType = $mediaType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.grid.media.backdrop');
    }
}
