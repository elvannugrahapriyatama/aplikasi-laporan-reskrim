<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginPelapor()
    {
        return view('auth.login-pelapor');
    }

    public function showLoginPetugas()
    {
        return view('auth.login-petugas');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar.'])->withInput($request->only('email'));
        }

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'petugas') {
                return redirect()->intended('/petugas/dashboard');
            }
            return redirect()->intended('/pelapor/dashboard');
        }

        return back()->withErrors(['password' => 'Password yang Anda masukkan salah.'])->withInput($request->only('email'));
    }

    public function showRegisterPelapor()
    {
        return view('auth.register-pelapor');
    }

    public function registerPelapor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['no_telepon'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'pelapor',
        ]);

        return redirect('/pelapor/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout(Request $request)
    {
        $role = Auth::user()->role ?? 'pelapor';
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($role === 'petugas') {
            return redirect('/petugas/login')->with('success', 'Berhasil logout.');
        }
        return redirect('/pelapor/login')->with('success', 'Berhasil logout.');
    }
}