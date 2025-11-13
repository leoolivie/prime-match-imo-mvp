<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        $redirect = $request->input('redirect');

        if ($redirect && Str::startsWith($redirect, '/') && !Str::contains($redirect, '://') && !Str::contains($redirect, '//')) {
            $request->session()->put('url.intended', $redirect);
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->intended($this->getRedirectPath());
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:investor,businessman',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'terms' => 'required|accepted',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
        ]);

        Auth::login($user);

        return redirect($this->getRedirectPath());
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function getRedirectPath(): string
    {
        $user = Auth::user();

        return match ($user->role) {
            'master' => '/master/dashboard',
            'prime_broker' => '/broker/dashboard',
            'businessman' => '/businessman/dashboard',
            'investor' => '/investor/dashboard',
            default => '/dashboard',
        };
    }
}
