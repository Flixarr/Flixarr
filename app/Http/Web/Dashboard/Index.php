<?php

namespace App\Http\Web\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public $posts;

    public function render()
    {
        return view('web.dashboard.index');
    }

    public function mount()
    {
        $this->posts = [
            [
                'id' => 1,
                'title' => 'Post one title',
                'body' => 'This is the body of post one.This is the body of post one.This is the body of post one.This is the body of post one.',
            ],
            [
                'id' => 2,
                'title' => 'Post two title',
                'body' => 'This is the body of post two.',
            ],
            [
                'id' => 3,
                'title' => 'Post three title',
                'body' => 'This is the body of post three.',
            ],
        ];
    }
}
