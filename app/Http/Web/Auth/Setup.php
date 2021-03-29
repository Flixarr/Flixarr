<?php

namespace App\Http\Web\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Setup extends Component
{
    public $firstName;
    public $lastName;
    public $requirePassword;

    public function render()
    {
        return view('web.auth.setup')->layout('layouts.auth');
    }

    public function submit()
    {
        $validator = Validator::make([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ], [
            'firstName' => 'required',
            'lastName' => 'required',
        ], [
            'firstName.required' => 'Your first and last name is required.',
            'lastName.required' => 'Your first and last name is required.',
        ]);

        if ($validator->fails()) {
            $this->dispatchBrowserEvent('alert-error', ['title' => $validator->messages()->first()]);
            return;
        }

        $user = User::where('id', auth()->user()->id)->first();

        $user->first_name = ucfirst($this->firstName);
        $user->last_name = ucfirst($this->lastName);
        $user->require_password = (int) $this->requirePassword;
        $user->setup = 1;

        $user->save();

        return redirect()->intended()->route('index');

    }
}
