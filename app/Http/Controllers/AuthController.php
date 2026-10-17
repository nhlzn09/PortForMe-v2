<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show(string $mode) { return view('auth', compact('mode')); }

    public function register(Request $r)
    {
        $r->merge(['username' => strtolower($r->input('username', '')), 'email' => strtolower($r->input('email', ''))]);
        $d = $r->validate([
            'username' => ['required', 'regex:/^[a-z0-9_]{3,20}$/', 'unique:users,username'],
            'email'    => ['required', 'email', 'max:120', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ], ['username.regex' => 'Username: 3-20 letters, numbers or underscores.']);

        $u = User::create(['name' => $d['username'], 'username' => $d['username'], 'email' => $d['email'], 'password' => $d['password']]);
        Auth::login($u);
        $r->session()->regenerate();
        return redirect()->route('portfolio.create');
    }

    public function login(Request $r)
    {
        $r->validate(['login' => 'required', 'password' => 'required']);
        $id = strtolower($r->input('login'));
        $field = str_contains($id, '@') ? 'email' : 'username';
        if (Auth::attempt([$field => $id, 'password' => $r->input('password')], $r->boolean('remember'))) {
            $r->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors(['login' => 'Wrong username or password.'])->onlyInput('login');
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect('/');
    }
}
