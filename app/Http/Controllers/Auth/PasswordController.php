<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function change(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', Rules\Password::defaults()],
            //'password_confirmation' => ['required', Rules\Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($request['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
