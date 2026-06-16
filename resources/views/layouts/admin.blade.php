<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin') — Royal Crown Hotel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        <div class="flex items-center gap-2 mb-1.5">
            <div class="w-px h-4 bg-[#B8935A]"></div>
            <p class="text-[#B8935A] text-xs tracking-[0.35em] uppercase" style="font-family: 'Montserrat', sans-serif;">Luxury Collection</p>
        </div>
        <h2 class="text-xl font-semibold text-white" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.03em;">
            Royal Crown <em class="text-[#D4B896] font-normal">Hotel</em>
        </h2>
        <p class="text-[#A89880]/70 text-xs mt-1.5 tracking-wider" style="font-family: 'Montserrat', sans-serif;">Panel Administrasi</p>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 py-6 overflow-y-auto no-scrollbar">
        <div class="px-6 mb-3">
            <p class="text-[#8C7B65] text-[10px] tracking-[0.25em] uppercase font-bold">Utama</p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>Dashboard</span>
        </a>

        <div class="px-6 mt-6 mb-3">
            <p class="text-[#8C7B65] text-[10px] tracking-[0.25em] uppercase font-bold">Master Data</p>
        </div>

        <a href="{{ route('admin.room-types.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.room-types.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <span>Tipe Kamar</span>
        </a>

        <a href="{{ route('admin.seasonal-rates.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.seasonal-rates.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                <circle cx="12" cy="12" r="9"/>
            </svg>
            <span>Harga Dinamis</span>
        </a>

        <a href="{{ route('admin.rooms.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
            </svg>
            <span>Kamar</span>
        </a>

        <a href="{{ route('admin.facilities.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
            </svg>
            <span>Fasilitas</span>
        </a>

        <div class="px-6 mt-6 mb-3">
            <p class="text-[#8C7B65] text-[10px] tracking-[0.25em] uppercase font-bold">Transaksi</p>
        </div>

        <a href="{{ route('admin.reservations.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <span>Reservasi</span>
        </a>

        <div class="px-6 mt-6 mb-3">
            <p class="text-[#8C7B65] text-[10px] tracking-[0.25em] uppercase font-bold">Pengguna</p>
        </div>

        <a href="{{ route('admin.customers.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span>Pelanggan</span>
        </a>
    </nav>

    {{-- User + Logout --}}
    <div class="px-5 py-5 border-t" style="border-color: rgba(184,147,90,0.15);">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 flex items-center justify-center text-white text-base font-semibold shrink-0"
                 style="background-color: #B8935A;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-white text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                <p class="text-[#A89880] text-xs tracking-wider truncate">Administrator</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-2.5 px-3 py-2 text-sm text-[#8C7B65] hover:text-[#D4B896] tracking-widest uppercase transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
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
            <h1 class="text-xl font-semibold text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.03em;">
                @yield('page_title', 'Dashboard')
            </h1>
            @hasSection('breadcrumb')
            <p class="text-xs text-[#A89880] tracking-wider mt-0.5" style="font-family: 'Montserrat', sans-serif;">@yield('breadcrumb')</p>
            @endif
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden sm:block text-right">
                <p class="text-sm font-semibold text-[#2A1D14]">{{ auth()->user()->name }}</p>
                <p class="text-xs text-[#A89880] tracking-wider">Admin</p>
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
        <p class="text-sm text-[#A89880] tracking-widest uppercase text-center">
            &copy; {{ date('Y') }} Royal Crown Hotel · Panel Administrasi
        </p>
    </footer>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
    document.getElementById('sidebarOverlay').classList.toggle('hidden');
}
</script>

{{-- Global Luxury Confirmation Modal --}}
<div id="luxuryConfirmModal" class="fixed inset-0 z-[99] hidden opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-[#2A1D14]/70 backdrop-blur-sm" onclick="closeLuxuryModal()"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div id="luxuryModalPanel" class="relative transform overflow-hidden bg-[#FDFCF8] text-left shadow-2xl transition-all duration-300 scale-95 opacity-0 sm:my-8 sm:w-full sm:max-w-md border border-[#B8935A]/30">
                <div class="h-1 w-full" style="background: linear-gradient(90deg, transparent, #B8935A, transparent);"></div>
                <div class="px-6 py-8 sm:px-10 sm:py-10 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#F7F4EE] border border-[#EDE8DC] mb-6">
                        <svg class="h-8 w-8 text-[#8C2323]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-light text-[#2A1D14] mb-3" id="luxuryModalTitle" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Konfirmasi</h3>
                    <p class="text-sm text-[#8C7B65] leading-relaxed" id="luxuryModalDesc">Apakah Anda yakin ingin melanjutkan tindakan ini?</p>
                </div>
                <div class="bg-[#F7F4EE] px-6 py-4 border-t border-[#EDE8DC] flex flex-col-reverse sm:flex-row sm:justify-center gap-3">
                    <button type="button" onclick="closeLuxuryModal()" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 text-xs font-semibold tracking-widest uppercase text-[#705F4A] bg-white border border-[#EDE8DC] hover:bg-[#FDFCF8] hover:text-[#2A1D14] transition-colors focus:outline-none">
                        Batal
                    </button>
                    <form id="luxuryModalForm" method="POST" action="" class="w-full sm:w-auto m-0 p-0">
                        @csrf
                        <input type="hidden" name="_method" id="luxuryModalMethod" value="DELETE">
                        <button type="submit" id="luxuryModalSubmitBtn" class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 text-xs font-semibold tracking-widest uppercase text-white bg-[#8C2323] hover:bg-[#5C1515] transition-colors focus:outline-none shadow-md">
                            Konfirmasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openLuxuryModal(actionUrl, method, title, desc, btnText, btnColor = 'bg-[#8C2323] hover:bg-[#5C1515]') {
        document.getElementById('luxuryModalForm').action = actionUrl;
        document.getElementById('luxuryModalMethod').value = method;
        document.getElementById('luxuryModalTitle').innerText = title;
        document.getElementById('luxuryModalDesc').innerText = desc;
        
        const submitBtn = document.getElementById('luxuryModalSubmitBtn');
        submitBtn.innerText = btnText;
        submitBtn.className = `w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 text-xs font-semibold tracking-widest uppercase text-white transition-colors focus:outline-none shadow-md ${btnColor}`;
        
        const modal = document.getElementById('luxuryConfirmModal');
        const panel = document.getElementById('luxuryModalPanel');
        
        modal.classList.remove('hidden');
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        panel.classList.remove('scale-95', 'opacity-0');
        panel.classList.add('scale-100', 'opacity-100');
    }

    function closeLuxuryModal() {
        const modal = document.getElementById('luxuryConfirmModal');
        const panel = document.getElementById('luxuryModalPanel');
        
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        panel.classList.remove('scale-100', 'opacity-100');
        panel.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
</body>
</html>
