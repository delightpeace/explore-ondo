<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function signupForm(): View
    {
        return view('signup');
    }

    public function signup(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create($validated);

        return to_route('login')
            ->with('status', 'Account created successfully. You can now log in.')
            ->withInput($request->only('email'));
    }

    public function loginForm(): View
    {
        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $adminEmails = config('app.admin_emails');

        if (! in_array($credentials['email'], $adminEmails)) {
            return redirect()->route('login')->withErrors(['email' => 'You do not have access to this resource.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/places');
        }

        return to_route('login')
            ->withErrors(['email' => 'The email address or password is incorrect.'])
            ->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function requestEMailToResetPassword(Request $request): RedirectResponse
    {
        $payload = $request->validate(['email' => ['required', 'email', 'max:255']]);
        $email = $payload['email'];

        if (User::where('email', $email)->exists()) {
            $generatedToken = bin2hex(random_bytes(5));
            Cache::put('password_reset_token_'.$email, Hash::make($generatedToken), now()->addMinutes(10));
            Mail::to($email)->queue(new ResetPasswordEmail($email, $generatedToken));
        }

        $request->session()->put('password_reset_email', $email);

        return to_route('password.reset')
            ->with('status', 'If an account exists for this email, a reset code has been sent. The code expires in 10 minutes.');
    }

    public function resetPasswordForm(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('password_reset_email')) {
            return to_route('password.request');
        }

        return view('reset-password', ['email' => $request->session()->get('password_reset_email')]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'code' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $email = $request->session()->get('password_reset_email');

        if (! is_string($email)) {
            return to_route('password.request')->withErrors(['email' => 'Please request a new reset code.']);
        }

        $cacheKey = 'password_reset_token_'.$email;
        $lock = Cache::lock($cacheKey.'_lock', 10);

        if (! $lock->get()) {
            return to_route('password.reset')->withErrors(['code' => 'A reset is already being processed. Please try again.']);
        }

        try {
            $hashedCode = Cache::get($cacheKey);
            $user = User::where('email', $email)->first();

            if (! is_string($hashedCode) || ! Hash::check($payload['code'], $hashedCode) || ! $user) {
                throw ValidationException::withMessages(['code' => 'The reset code is invalid or has expired. Please request a new code.']);
            }

            $user->forceFill([
                'password' => $payload['password'],
                'remember_token' => Str::random(60),
            ])->save();

            Cache::forget($cacheKey);
        } finally {
            $lock->release();
        }

        $request->session()->forget('password_reset_email');

        return to_route('login')
            ->with('status', 'Your password has been reset. You can now log in.')
            ->withInput(['email' => $email]);
    }
}
