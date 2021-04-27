<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Loading extends Component
{
    public $size;
    public $color;

    public function __construct(string $size = "8", string $color = 'gray-600')
    {
        $this->size = $size;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.loading');
    }
}
