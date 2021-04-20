<?php

namespace App\Http\Controllers\Index;

use Livewire\Component;

class IndexController extends Component
{
    public $netflix;

    public function view()
    {
        return view('web.index.index');
    }

}
