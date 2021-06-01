<?php

namespace App\Http\Controllers\Pages\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TosController extends Controller
{
    public $title;

    public function __construct()
    {
        $this->title = "Terms of Service";
    }

    public function agreeToTerms(Request $request)
    {
        $request->validate([
            'agree' => ['required'],
        ], [
            'agree.required' => 'You need to agree to the Terms of Service.'
        ]);

        return redirect()->route('setup.database');
    }
}
