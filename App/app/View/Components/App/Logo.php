<?php

namespace App\View\Components\App;

use Illuminate\View\Component;

class Logo extends Component
{
    public $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $size = 10)
    {
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app.logo');
    }
}
