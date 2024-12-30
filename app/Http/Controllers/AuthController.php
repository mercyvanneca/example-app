<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan form signup
    public function showSignupForm()
    {
        return view('auth.signup');  // Mengembalikan tampilan form signup
    }

    // Menangani proses signup
    public function signup(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Membuat pengguna baru di database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah signup berhasil
        Auth::login($user);

        // Redirect ke halaman login setelah signup selesai
        return redirect()->route('login');  // Mengarahkan ke halaman login setelah signup berhasil
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');  // Mengembalikan tampilan form login
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Menentukan apakah email dan password sesuai dengan yang ada di database
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika berhasil login, alihkan ke halaman welcome
            return redirect()->route('welcome');
        }

        // Jika gagal login, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Menangani proses logout
    public function logout()
    {
        // Logout pengguna
        Auth::logout();
    
        // Redirect ke halaman login
        return redirect()->route('login');  // Mengarahkan ke halaman login setelah logout
    }
}
