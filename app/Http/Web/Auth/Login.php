<?php

namespace App\Http\Web\Auth;

use App\Models\API\Plex;
use Livewire\Component;

class Login extends Component
{
    public $message;
    public $plexAuthStarted;
    public $plexWindowOpen;
    public $plexAuthCompleted;
    public $pinId;
    public $plexUserData;

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
        $this->message = 'Let\'s sign in with your <span class="text-primary-500 font-medium">Plex Account</span>';
        $this->plexAuthStarted = false;
        $this->plexWindowOpen = false;
        $this->plexAuthCompleted = false;
    }

    public function getPlexAuthUrl()
    {
        if ($this->plexAuthCompleted) {
            $this->dispatchBrowserEvent('alert-success', ['title' => 'Signin Completed', 'message' => 'You have already successfully signed in with Plex.']);
            return false;
        }

        $pinData = (new Plex)->getAuthPin();

        while (!isset($pinData['id'])) {
            sleep(1);
        }

        $this->pinId = $pinData['id'];

        return (new Plex)->getAuthUrl($pinData['code']);
    }

    /**
     * This should return whether or not the validator needs to run again
     *
     * @return boolean
     */
    public function validatePlexPin()
    {
        if ($this->plexAuthCompleted) {
            $this->dispatchBrowserEvent('alert-success', ['title' => 'Signin Completed', 'message' => 'You have already successfully signed in with Plex.']);
            return false;
        }

        if (!$this->plexWindowOpen) {
            $this->plexAuthStarted = false;
            $this->dispatchBrowserEvent('alert-error', ['title' => 'Login Failed', 'message' => 'The popup was closed before completing login.']);
            return false;
        }

        $response = (new Plex)->validateAuthPin($this->pinId);

        if ($response['status'] === 'error') {
            $this->plexAuthStarted = false;
            $this->dispatchBrowserEvent('alert-error', ['title' => 'System Error', 'message' => $response['message']]);
            $this->dispatchBrowserEvent('consolelog', ['data' => $response['data']]);
            return false;
        }

        if ($response['status'] === 'invalid') {
            return true;
        }

        if ($response['status'] === 'valid') {
            $this->plexUserData = $response;
            (new Plex)->saveAuthToken($response['data']['authToken']);
            $this->setPlexAuthCompleted();
            return false;
        }
    }

    public function setPlexAuthCompleted()
    {
        $this->dispatchBrowserEvent('alert-success', ['title' => 'Successfully signed in!', 'message' => 'You have successfully signed in with Plex!']);

        dd((new Plex)->getServers());

        $this->plexAuthCompleted = true;
    }

    /**
     * ===========================
     */

    // public function verifyUser()
    // {
    //     // Reset valiation & revalidate
    //     $this->resetValidation();

    //     $this->validate();
    //     // Validation Passes

    //     // Is the user registered locally?
    //     if ($localUser = User::where('email', $this->email)->first()) {
    //         // Yes, the user is registered

    //         // Verify Plex User via Email
    //         if ($plexUser = (new Plex)->verifyUserAccessViaId($localUser['plex_id'])) {

    //             // Does the user's email address need to be updated?
    //             if ($localUser['email'] != $plexUser['email']) {
    //                 // Yes, update it
    //                 $localUser->email = $plexUser['email'];
    //                 $localUser->save();
    //             }

    //             // Does the user require a password?
    //             if ($localUser['require_password']) {
    //                 // Yes, user requires password - show password
    //                 $this->showPassword = true;
    //                 $this->message = 'Enter your <span class="text-primary-500 font-semibold">Password</span> to sign in.';
    //                 $this->submitType = 'signIn';
    //             } else {
    //                 // No, user does not require password - authenticate user
    //                 $this->authenticate($localUser);
    //             }
    //         } else {
    //             $this->dispatchBrowserEvent('alert-error', ['time' => '7000', 'title' => 'Access Denied', 'message' => '<span class="font-medium text-white">' . $this->email . '</span> does not have access to the plex server.']);
    //             return;
    //         }

    //     } else {
    //         // No, the user is not registered
    //         $this->showPassword = true;
    //         $this->message = 'Since this is your first time signing in, you\'ll need to enter your <span class="text-primary-500 font-semibold">Plex Password</span> so the system can download your Plex profile and create your account.';
    //         $this->buttonText = 'Create Account';
    //         $this->submitType = 'createAccount';
    //     }
    // }

    // public function signIn()
    // {
    //     $this->resetValidation();
    //     $credentials = $this->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     $user = User::where('email', $this->email)->first();

    //     if (Auth::attempt($credentials)) {
    //         $this->authenticate($user);
    //         return;
    //     }

    //     $this->dispatchBrowserEvent('alert-error', ['title' => 'Login Error', 'message' => 'The password you entered is not correct']);
    // }

    // public function createAccount()
    // {
    //     $this->resetValidation();
    //     $this->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     // get user's plex data
    //     $plexData = (new Plex)->getUserData($this->email, $this->password);

    //     // check if plex returned any errors
    //     if (isset($plexData['error'])) {
    //         $this->dispatchBrowserEvent('alert-error', ['title' => 'Plex said...', 'message' => $plexData['error']]);
    //         return;
    //     }

    //     // Create a new local user
    //     $user = (new User)->createNewUser($plexData, $this->password);

    //     // Authenticate user
    //     $this->authenticate($user);
    // }

    // public function authenticate($user)
    // {
    //     // Authenticate a new session
    //     Auth::login($user);
    //     session()->regenerate();
    //     // redirect
    //     return redirect()->intended('/');
    // }
}
