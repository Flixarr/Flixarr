<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $color;
    public $link;
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $type = "button", ?string $color = "primary", ?string $link = "", ?bool $disabled = false)
    {
        $this->type = $type;
        $this->color = $color;
        $this->link = $link;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.button');
    }
}
