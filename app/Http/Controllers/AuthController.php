<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:256'],
            'password' => ['required', 'string', 'max:256'],
        ]);

        if (Auth::attempt($request->except(['_token', 'submit']))) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with([
                'failure' => 'Invalid login details!'
            ]);
        }
    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:256'],
            'email' => ['required', 'email', 'max:256', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'string', 'max:256'],
        ]);

        if (User::create($request->all())) {
            return redirect()->back()->with([
                'success' => 'Magic has been spelled!'
            ]);
        } else {
            return redirect()->back()->with([
                'failure' => 'Magic has failed to spell!'
            ]);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
