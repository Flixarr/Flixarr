<?php

namespace App\Http\Web\Auth;

use App\Models\API\Plex;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $message;
    public $showPassword = false;
    public $submitType;

    protected $rules = [
        'email' => ['required', 'email'],
    ];

    protected $messages = [
        'email.required' => 'Invalid email address',
        'email.email' => 'Invalid email address',
    ];

    public function render()
    {
        return view('web.auth.login')->layout('layouts.auth');
    }

    public function mount()
    {
        $this->message = 'To sign in, enter your <span class="text-primary-500 font-medium">Plex Email Address</span>';
        $this->email = 'marcneryn@gmail.com';
        $this->submitType = 'verifyUser';
    }

    public function clear_errors()
    {
        $this->resetValidation();
    }

    public function verifyUser()
    {
        // Reset valiation & revalidate
        $this->resetValidation();

        $this->validate();
        // Validation Passes

        // Is the user registered locally?
        if ($localUser = User::where('email', $this->email)->first()) {
            // Yes, the user is registered

            // Verify Plex User via Email
            if ($plexUser = (new Plex)->verifyUserAccessViaId($localUser['plex_id'])) {

                // Does the user's email address need to be updated?
                if ($localUser['email'] != $plexUser['email']) {
                    // Yes, update it
                    $localUser->email = $plexUser['email'];
                    $localUser->save();
                }

                // Does the user require a password?
                if ($localUser['require_password']) {
                    // Yes, user requires password - show password
                    $this->showPassword = true;
                    $this->message = 'Enter your <span class="text-primary-500 font-semibold">Password</span> to sign in.';
                    $this->submitType = 'signIn';
                } else {
                    // No, user does not require password - authenticate user
                    $this->authenticate($localUser);
                }
            } else {
                $this->dispatchBrowserEvent('alert-error', ['time' => '7000', 'title' => 'Access Denied', 'message' => '<span class="font-medium text-white">' . $this->email . '</span> does not have access to the plex server.']);
                return;
            }

        } else {
            // No, the user is not registered
            $this->showPassword = true;
            $this->message = 'Since this is your first time signing in, you\'ll need to enter your <span class="text-primary-500 font-semibold">Plex Password</span> so the system can download your Plex profile and create your account.';
            $this->buttonText = 'Create Account';
            $this->submitType = 'createAccount';
        }
    }

    public function signIn()
    {
        $this->resetValidation();
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $this->email)->first();

        if (Auth::attempt($credentials)) {
            $this->authenticate($user);
            return;
        }

        $this->dispatchBrowserEvent('alert-error', ['title' => 'Login Error', 'message' => 'The password you entered is not correct']);
    }

    public function createAccount()
    {
        $this->resetValidation();
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // get user's plex data
        $plexData = (new Plex)->getUserData($this->email, $this->password);

        // check if plex returned any errors
        if (isset($plexData['error'])) {
            $this->dispatchBrowserEvent('alert-error', ['title' => 'Plex said...', 'message' => $plexData['error']]);
            return;
        }

        // Create a new local user
        $user = (new User)->createNewUser($plexData, $this->password);

        // Authenticate user
        $this->authenticate($user);
    }

    public function authenticate($user)
    {
        // Authenticate a new session
        Auth::login($user);
        session()->regenerate();
        // redirect
        return redirect()->intended('/');
    }
}
