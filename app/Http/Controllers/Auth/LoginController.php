<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan file view ini ada
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input hanya email dan password
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Hanya izinkan role staf dan guest
            if ($user->role === 'staf') {
                return redirect()->intended('/staf')->with('success', 'Selamat datang, Staf!');
            }else {
                Auth::logout();
                return back()->with('error', 'Akun Anda tidak diizinkan login.')->withInput();
            }
        }

        // Jika gagal login
        return back()->with('error', 'Email atau password salah!')->withInput();
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
