<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    // ─── Halaman & Proses Login ────────────────────────────────────────────

    /**
     * Tampilkan halaman login.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi pengguna.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau kata sandi salah.']);
        }

        $request->session()->regenerate();

        // Arahkan berdasarkan role
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return redirect()->route('customer.dashboard')
            ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
    }

    // ─── Halaman & Proses Registrasi ──────────────────────────────────────

    /**
     * Tampilkan halaman registrasi pelanggan.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran pelanggan baru.
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'customer',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('customer.dashboard')
            ->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->name . '!');
    }

    // ─── Logout ───────────────────────────────────────────────────────────

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing')
            ->with('success', 'Anda telah berhasil keluar.');
    }
}
