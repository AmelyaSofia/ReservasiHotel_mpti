<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin') — HotelKu</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|jost:300,400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex" style="background-color: #F7F4EE;">

{{-- ═══════════════════════════════════════════ SIDEBAR ══ --}}
<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-40 w-64 flex flex-col
           transform -translate-x-full lg:translate-x-0
           transition-transform duration-300 ease-in-out"
    style="background: linear-gradient(180deg, #2A1D14 0%, #1A1510 60%, #2A1D14 100%);">

    {{-- Brand --}}
    <div class="px-6 py-7 border-b" style="border-color: rgba(184, 147, 90, 0.2);">
        <div class="flex items-center gap-2 mb-1">
            <div class="w-px h-5 bg-[#B8935A]"></div>
            <p class="text-[#B8935A] text-xs tracking-[0.3em] uppercase font-medium">Luxury Collection</p>
        </div>
        <h2 class="text-2xl font-light text-white" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.05em;">
            Hotel<em class="text-[#D4B896]">Ku</em>
        </h2>
        <p class="text-[#705F4A] text-xs mt-1 tracking-wider">Panel Administrasi</p>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 py-6 overflow-y-auto">
        <div class="px-6 mb-3">
            <p class="text-[#705F4A] text-xs tracking-[0.2em] uppercase font-medium">Utama</p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <div class="px-6 mt-6 mb-3">
            <p class="text-[#705F4A] text-xs tracking-[0.2em] uppercase font-medium">Master Data</p>
        </div>

        <a href="{{ route('admin.room-types.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.room-types.*') ? 'active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            Tipe Kamar
        </a>

        <a href="{{ route('admin.rooms.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
            </svg>
            Kamar
        </a>

        <a href="{{ route('admin.facilities.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
            </svg>
            Fasilitas
        </a>

        <div class="px-6 mt-6 mb-3">
            <p class="text-[#705F4A] text-xs tracking-[0.2em] uppercase font-medium">Transaksi</p>
        </div>

        <a href="{{ route('admin.reservations.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Reservasi
        </a>
    </nav>

    {{-- User + Logout --}}
    <div class="px-5 py-5 border-t" style="border-color: rgba(184,147,90,0.15);">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-8 h-8 flex items-center justify-center text-white text-sm font-semibold shrink-0"
                 style="background-color: #B8935A;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white text-xs font-medium truncate">{{ auth()->user()->name }}</p>
                <p class="text-[#705F4A] text-xs truncate">Administrator</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-2.5 px-3 py-2 text-xs text-[#8C7B65] hover:text-[#D4B896] tracking-widest uppercase transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

{{-- Sidebar Overlay --}}
<div id="sidebarOverlay"
    class="fixed inset-0 z-30 bg-black/60 hidden lg:hidden"
    onclick="toggleSidebar()">
</div>

{{-- ══════════════════════════════════════ MAIN CONTENT ══ --}}
<div class="flex-1 flex flex-col min-h-full lg:ml-64">

    {{-- Top Bar --}}
    <header class="sticky top-0 z-20 bg-white border-b border-[#EDE8DC] px-5 sm:px-8 py-4 flex items-center gap-4">
        <button onclick="toggleSidebar()" class="lg:hidden p-1.5 text-[#8C7B65] hover:text-[#2A1D14] transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <div class="flex-1">
            <h1 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
                @yield('page_title', 'Dashboard')
            </h1>
            @hasSection('breadcrumb')
            <p class="text-xs text-[#A89880] tracking-wide mt-0.5">@yield('breadcrumb')</p>
            @endif
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden sm:block text-right">
                <p class="text-xs font-medium text-[#2A1D14]">{{ auth()->user()->name }}</p>
                <p class="text-xs text-[#A89880]">Admin</p>
            </div>
            <div class="w-8 h-8 flex items-center justify-center text-white text-xs font-semibold"
                 style="background-color: #B8935A;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </header>

    {{-- Flash Messages --}}
    <div class="px-5 sm:px-8 pt-5 space-y-3">
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

    <main class="flex-1 px-5 sm:px-8 py-7">
        @yield('content')
    </main>

    <footer class="px-8 py-4 border-t border-[#EDE8DC]">
        <p class="text-xs text-[#A89880] tracking-widest uppercase text-center">
            &copy; {{ date('Y') }} HotelKu · Panel Administrasi
        </p>
    </footer>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
    document.getElementById('sidebarOverlay').classList.toggle('hidden');
}
</script>
</body>
</html>
