<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'You have been logged out successfully.');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where(['email' => $credentials['email']])->first();

        if ($user === null) {
            return back()->withErrors("Nie udało się zalogować")->withInput();
        }

        if ($user->password === null) {
            return redirect(route("reset-password", ['email' => $credentials['email']]))->withInput();
        }

        if ($user->password && $user->resetPassword?->token) {
            return back()->withErrors("Reset hasła w toku")->withInput();
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('songs.index'));
        }

        return back()->withErrors('Email lub hasło są niepoprawne')->onlyInput('email');
    }


    public function setupNewPassword(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'token' => ['required'],
        ]);

        $user = User::where(['email' => $credentials['email']])->first();

        if ($user === null) {
            return back()->withErrors("Brak takiego uytkownika")->withInput();
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return ($status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors([__($status)]))->withInput();
    }
}
