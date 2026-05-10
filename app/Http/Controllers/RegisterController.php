<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class RegisterController extends Controller
{
    public function create(): Response {
        return inertia('Auth/Register');
    }

    public function store(Request $request): RedirectResponse {
        $user = User::create($request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]));

        // $user->save();
        Auth::login($user);

        return redirect()->route('login')->with('success', 'You are registered and can login!');
    }
}
