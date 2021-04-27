<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $hasTopNavigation;
    public $hasBottomNavigation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hasTopNavigation = false, $hasBottomNavigation = false)
    {
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
        return view('layouts.app');
    }
}
