<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show a login page for users
     */
    public function home()
    {
        //
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('articles');
        }

        return back()->withErrors([
            'username' => 'Onjuiste inloggegevens. Probeer opnieuw',
        ]);

    }
}
