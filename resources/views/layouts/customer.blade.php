<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') — HotelKu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-50">

{{-- ══════════════════════════════════════════════════════════ NAVBAR ══ --}}
<nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-200/70 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2.5 group">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-sm shadow-blue-600/30 group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-lg font-bold text-slate-800">HotelKu</span>
            </a>

            {{-- Nav Links --}}
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('customer.dashboard') }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
                          {{ request()->routeIs('customer.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                    Beranda
                </a>
                <a href="{{ route('customer.catalog.index') }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
                          {{ request()->routeIs('customer.catalog.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                    Cari Kamar
                </a>
                <a href="{{ route('customer.reservations.index') }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition-colors
                          {{ request()->routeIs('customer.reservations.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                    Reservasi Saya
                </a>
            </div>

            {{-- User Menu --}}
            <div class="flex items-center gap-3">
                <div class="hidden md:flex flex-col items-end">
                    <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-400">Pelanggan</p>
                </div>
                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="hidden md:flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-medium
                               text-slate-500 hover:text-red-600 hover:bg-red-50 transition-colors border border-slate-200">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>

                {{-- Mobile Menu Toggle --}}
                <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                    class="md:hidden p-2 rounded-xl text-slate-500 hover:bg-slate-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden border-t border-slate-200 py-3 space-y-1">
            <a href="{{ route('customer.dashboard') }}" class="block px-4 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-100">Beranda</a>
            <a href="{{ route('customer.catalog.index') }}" class="block px-4 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-100">Cari Kamar</a>
            <a href="{{ route('customer.reservations.index') }}" class="block px-4 py-2 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-100">Reservasi Saya</a>
            <form method="POST" action="{{ route('logout') }}" class="px-4 pt-2">
                @csrf
                <button type="submit" class="text-sm text-red-600 font-medium">Keluar</button>
            </form>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if (session('success') || session('error'))
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 space-y-3">
    @if (session('success'))
        <div class="alert-success">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert-error">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif
</div>
@endif

{{-- Page Content --}}
<main class="@yield('full_width', '') max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @yield('content')
</main>

<footer class="mt-16 border-t border-slate-200 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <span class="font-bold text-slate-800">HotelKu</span>
        </div>
        <p class="text-sm text-slate-400">&copy; {{ date('Y') }} HotelKu. Semua hak dilindungi.</p>
    </div>
</footer>

</body>
</html>
