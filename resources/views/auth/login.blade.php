@extends('layouts.guest')

@section('title', 'Masuk')
@section('meta_description', 'Masuk ke akun HotelKu Anda untuk mengelola reservasi kamar hotel.')

@section('content')
<div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-3xl p-8 shadow-2xl">

    {{-- Header --}}
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-white">Selamat Datang Kembali</h1>
        <p class="text-blue-200 text-sm mt-1.5">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="alert-error mb-6">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    {{-- Form --}}
    <form id="loginForm" method="POST" action="{{ route('login.post') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-blue-100 mb-1.5">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4.5 h-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    class="form-input pl-10 {{ $errors->has('email') ? 'border-red-400 focus:ring-red-400' : '' }}"
                    required autofocus>
            </div>
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-blue-100 mb-1.5">Kata Sandi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4.5 h-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="form-input pl-10 pr-10 {{ $errors->has('password') ? 'border-red-400 focus:ring-red-400' : '' }}"
                    required>
                {{-- Toggle show/hide password --}}
                <button type="button" onclick="togglePassword('password', 'eyeIcon')"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                    <svg id="eyeIcon" class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
            <label for="remember" class="ml-2 text-sm text-blue-100">Ingat saya</label>
        </div>

        {{-- Submit --}}
        <button type="submit" id="loginBtn" class="btn-primary w-full py-3 text-base mt-2">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Masuk
        </button>
    </form>

    {{-- Divider --}}
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-white/20"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="px-4 text-xs text-blue-300 bg-transparent">atau</span>
        </div>
    </div>

    {{-- Register Link --}}
    <p class="text-center text-sm text-blue-200">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-white hover:text-blue-200 underline underline-offset-2 transition-colors">
            Daftar Sekarang
        </a>
    </p>
</div>

{{-- Demo Credentials --}}
<div class="mt-4 p-4 bg-white/5 border border-white/10 rounded-2xl">
    <p class="text-xs text-blue-300 font-semibold text-center mb-2">💡 Akun Demo</p>
    <div class="grid grid-cols-2 gap-2 text-xs text-blue-200">
        <div class="bg-white/5 rounded-xl px-3 py-2">
            <p class="font-semibold text-white">Admin</p>
            <p>admin@hotel.com</p>
            <p>admin123</p>
        </div>
        <div class="bg-white/5 rounded-xl px-3 py-2">
            <p class="font-semibold text-white">Pelanggan</p>
            <p>Daftar sendiri</p>
            <p>Min. 8 karakter</p>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
}

// Loading state on submit
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    btn.disabled = true;
    btn.innerHTML = `
        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
        Memproses...
    `;
});
</script>
@endsection
