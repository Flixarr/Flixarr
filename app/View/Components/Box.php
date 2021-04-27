<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Box extends Component
{
    public $title;
    public $moreLink;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $moreLink = null)
    {
        $this->title = $title;
        $this->moreLink = $moreLink;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.box');
    }
}
