<?php

namespace App\View\Components;

use Illuminate\View\Component;

class button extends Component
{
    public $text;
    public $width;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $text, string $width = 'auto')
    {
        $this->text = $text;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
