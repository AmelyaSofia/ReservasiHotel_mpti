@extends('layouts.guest')

@section('title', 'Masuk')
@section('meta_description', 'Masuk ke akun Royal Crown Hotel Anda.')

@section('content')

{{-- Header --}}
<div class="mb-8">
    <p class="text-xs text-[#B8935A] tracking-[0.2em] uppercase font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">Selamat Datang Kembali</p>
    <h2 class="text-2xl font-semibold text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">
        Masuk ke Akun Anda
    </h2>
    <div class="w-8 h-0.5 bg-[#B8935A] mt-3 mb-1"></div>
    <p class="text-sm text-[#8C7B65]">Akses portal reservasi eksklusif Anda</p>
</div>

{{-- Error --}}
@if ($errors->any())
    <div class="alert-error mb-5">
        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ $errors->first() }}
    </div>
@endif

{{-- Form --}}
<form id="loginForm" method="POST" action="{{ route('login.post') }}" class="space-y-5">
    @csrf

    {{-- Email --}}
    <div>
        <label for="email" class="form-label">Alamat Email</label>
        <input id="email" name="email" type="email" autocomplete="email"
            value="{{ old('email') }}"
            placeholder="nama@email.com"
            class="form-input-box {{ $errors->has('email') ? 'border-red-500' : '' }}"
            required autofocus>
        @error('email')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div>
        <label for="password" class="form-label">Kata Sandi</label>
        <div class="relative">
            <input id="password" name="password" type="password" autocomplete="current-password"
                placeholder="Kata sandi Anda"
                class="form-input-box pr-10 {{ $errors->has('password') ? 'border-red-500' : '' }}"
                required>
            <button type="button" onclick="togglePass('password')"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#A89880] hover:text-[#5C4033] transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
        </div>
        @error('password')
            <p class="form-error">{{ $message }}</p>
        @enderror
    </div>

    {{-- Remember --}}
    <div class="flex items-center gap-2.5">
        <input id="remember" name="remember" type="checkbox"
            class="w-4 h-4 border-[#D9CEB8] text-[#B8935A] focus:ring-[#B8935A] rounded-none">
        <label for="remember" class="text-sm text-[#8C7B65]">Ingat saya</label>
    </div>

    {{-- Submit --}}
    <button type="submit" id="loginBtn" class="btn-primary w-full py-3.5 mt-2 text-sm">
        Masuk ke Portal
    </button>
</form>

{{-- Divider --}}
<div class="flex items-center gap-3 my-6">
    <div class="flex-1 h-px bg-[#EAE3D5]"></div>
    <span class="text-[#C9A96E] text-xs">✦</span>
    <div class="flex-1 h-px bg-[#EAE3D5]"></div>
</div>

{{-- Register Link --}}
<p class="text-center text-sm text-[#8C7B65]">
    Belum memiliki akun?
    <a href="{{ route('register') }}" class="text-[#B8935A] font-semibold hover:text-[#9E7A42] underline underline-offset-2 transition-colors ml-1">
        Daftar Sekarang
    </a>
</p>

<script>
function togglePass(id) {
    const i = document.getElementById(id);
    i.type = i.type === 'password' ? 'text' : 'password';
}
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    btn.disabled = true;
    btn.textContent = 'Memproses...';
});
</script>
@endsection
