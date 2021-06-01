<?php

namespace App\View\Components\forms;

use Illuminate\View\Component;

class Input extends Component
{
    public $id;
    public $name;
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $id, string $name, string $placeholder = "")
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
