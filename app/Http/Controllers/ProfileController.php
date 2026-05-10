<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request): RedirectResponse {
        $user = $request->user();

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        // Handle avatar upload
        if($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store the file and get path
            $path = $request->file('avatar')->store('avatars', 'public');

            // Add path to validated data
            $validatedData['avatar'] = $path;
        } else {
            unset($validatedData['avatar']);
        }

         $user->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Profile info updated!');
    }
}
