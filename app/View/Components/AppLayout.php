<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $type;
    public $hasTopNavigation;
    public $hasBottomNavigation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = null, $hasTopNavigation = false, $hasBottomNavigation = false)
    {
        $this->type = $type;
        $this->hasTopNavigation = $hasTopNavigation;
        $this->hasBottomNavigation = $hasBottomNavigation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if ($this->type === 'minimal') {
            return view('layouts.minimal');
        }

        return view('layouts.app');
    }
}
