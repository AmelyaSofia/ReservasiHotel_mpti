<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') — Royal Crown Hotel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|jost:300,400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" style="background-color: #F7F4EE;">

{{-- ═══════════════════════════════════════════ NAVBAR ══ --}}
<nav class="sticky top-0 z-40 bg-white border-b border-[#EDE8DC]">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
        <div class="flex items-center justify-between h-18 py-4">

            {{-- Logo --}}
            <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 group">
                <div class="flex items-center gap-2">
                    <div class="w-px h-6 bg-[#B8935A] group-hover:h-8 transition-all duration-300"></div>
                    <div>
                        <h2 class="text-2xl font-light text-[#2A1D14] leading-none"
                            style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.05em;">
                            Royal Crown <em class="text-[#B8935A]">Hotel</em>
                        </h2>
                        <p class="text-[#A89880] text-sm tracking-[0.2em] uppercase leading-none mt-0.5">Luxury Collection</p>
                    </div>
                </div>
            </a>

            {{-- Nav Links --}}
            <div class="hidden md:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['route' => 'customer.dashboard',          'label' => 'Beranda',       'pattern' => 'customer.dashboard'],
                        ['route' => 'customer.catalog.index',      'label' => 'Kamar',         'pattern' => 'customer.catalog.*'],
                        ['route' => 'customer.reservations.index', 'label' => 'Reservasi Saya','pattern' => 'customer.reservations.*'],
                    ];
                @endphp
                @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="relative px-4 py-2 text-sm tracking-widest uppercase transition-colors duration-200 group
                          {{ request()->routeIs($link['pattern'])
                                ? 'text-[#B8935A]'
                                : 'text-[#8C7B65] hover:text-[#2A1D14]' }}">
                    {{ $link['label'] }}
                    <span class="absolute bottom-0 left-4 right-4 h-px bg-[#B8935A] transition-transform duration-200 origin-left
                                 {{ request()->routeIs($link['pattern']) ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                    </span>
                </a>
                @endforeach
            </div>

            {{-- User --}}
            <div class="flex items-center gap-4">
                <div class="hidden md:block text-right">
                    <p class="text-sm font-semibold text-[#2A1D14]">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-[#A89880] tracking-wider">Pelanggan</p>
                </div>
                <div class="w-10 h-10 flex items-center justify-center text-white text-sm font-semibold"
                     style="background-color: #B8935A;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                    @csrf
                    <button type="submit"
                        class="text-sm text-[#A89880] hover:text-[#5C4033] tracking-widest uppercase transition-colors border-b border-transparent hover:border-[#5C4033] pb-px">
                        Keluar
                    </button>
                </form>

                {{-- Mobile --}}
                <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                    class="md:hidden p-1.5 text-[#8C7B65]">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden border-t border-[#EDE8DC] py-4 space-y-1">
            <a href="{{ route('customer.dashboard') }}" class="block px-2 py-2.5 text-sm text-[#5C4033] tracking-widest uppercase hover:text-[#B8935A] transition-colors">Beranda</a>
            <a href="{{ route('customer.catalog.index') }}" class="block px-2 py-2.5 text-sm text-[#5C4033] tracking-widest uppercase hover:text-[#B8935A] transition-colors">Kamar</a>
            <a href="{{ route('customer.reservations.index') }}" class="block px-2 py-2.5 text-sm text-[#5C4033] tracking-widest uppercase hover:text-[#B8935A] transition-colors">Reservasi Saya</a>
            <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-[#EDE8DC] mt-2">
                @csrf
                <button type="submit" class="text-sm text-[#8C7B65] tracking-widest uppercase">Keluar</button>
            </form>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if (session('success') || session('error'))
<div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pt-5 space-y-3">
    @if (session('success'))
        <div class="alert-success">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert-error">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif
</div>
@endif

<main class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-10">
    @yield('content')
</main>

<footer style="background-color: #2A1D14;" class="mt-16">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="text-2xl font-light text-white" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.05em;">
                    Royal Crown <em class="text-[#D4B896]">Hotel</em>
                </h3>
                <p class="text-[#705F4A] text-sm tracking-widest uppercase mt-1">Luxury Collection</p>
            </div>
            <div class="w-8 h-px bg-[#B8935A]"></div>
            <p class="text-[#705F4A] text-sm tracking-widest uppercase">
                &copy; {{ date('Y') }} Royal Crown Hotel · Seluruh hak dilindungi
            </p>
        </div>
    </div>
</footer>

</body>
</html>
