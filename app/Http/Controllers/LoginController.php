<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);
        if (auth()->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'You are logged in');
        }

        return back()->withInput()->withErrors([
            'email', 'password' => 'Your Email or Password is not correct.',
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/');
    }
}
