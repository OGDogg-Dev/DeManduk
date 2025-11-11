<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(Request $request): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return view('auth.login');
    }

    public function showRegisterForm(Request $request): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return view('auth.register');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withErrors([
                'email' => 'Kredensial yang Anda masukkan tidak cocok dengan catatan kami.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User();
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => User::ROLE_CONTRIBUTOR,
            'requires_approval' => false,
        ]);
        $user->email_verified_at = now();
        $user->save();

        Auth::login($user);

        return redirect()->route('admin.dashboard')
            ->with('status', 'Registrasi berhasil. Selamat bergabung sebagai kontributor!');
    }
}
