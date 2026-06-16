<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') — Royal Crown Hotel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" style="background-color: #FAF7F2;">

{{-- ═══════════════════════════════════════════ NAVBAR ══ --}}
<nav class="sticky top-0 z-40 bg-white border-b border-[#EDE8DC]">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
        <div class="flex items-center justify-between h-18 py-4">

            {{-- Logo --}}
            <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 group">
                <div class="flex items-center gap-2.5">
                    <div class="w-px h-7 bg-[#B8935A] group-hover:h-9 transition-all duration-300"></div>
                    <div>
                        <h2 class="text-xl font-semibold text-[#2A1D14] leading-none"
                            style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.03em;">
                            Royal Crown <em class="text-[#B8935A] font-normal">Hotel</em>
                        </h2>
                        <p class="text-[#A89880] text-xs tracking-[0.22em] uppercase leading-none mt-0.5" style="font-family: 'Montserrat', sans-serif;">Luxury Collection</p>
                    </div>
                </div>
            </a>

            {{-- Nav Links --}}
            <div class="hidden md:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['route' => 'landing', 'label' => 'Beranda', 'pattern' => 'landing'],
                    ];
                    
                    if (auth()->check()) {
                        $navLinks[] = ['route' => 'customer.catalog.index', 'label' => 'Kamar', 'pattern' => 'customer.catalog.*'];
                        if (auth()->user()->isCustomer()) {
                            $navLinks[] = ['route' => 'customer.dashboard', 'label' => 'Dashboard', 'pattern' => 'customer.dashboard'];
                            $navLinks[] = ['route' => 'customer.reservations.index', 'label' => 'Reservasi Saya', 'pattern' => 'customer.reservations.*'];
                        }
                    } else {
                        // Guest can still view rooms, wait, catalog requires auth middleware right now.
                        // I will link to the #rooms section or login.
                    }
                @endphp
                @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="relative px-4 py-2 text-xs font-semibold tracking-[0.12em] uppercase transition-colors duration-200 group
                          {{ request()->routeIs($link['pattern'])
                                ? 'text-[#B8935A]'
                                : 'text-[#5C4033] hover:text-[#B8935A]' }}">
                    {{ $link['label'] }}
                    <span class="absolute bottom-0 left-4 right-4 h-px bg-[#B8935A] transition-transform duration-200 origin-left
                                 {{ request()->routeIs($link['pattern']) ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                    </span>
                </a>
                @endforeach
            </div>

            {{-- User --}}
            <div class="flex items-center gap-4">
                @auth
                    <div class="hidden md:block text-right">
                        <p class="text-sm font-semibold text-[#2A1D14]">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-[#A89880] tracking-wider">{{ auth()->user()->isAdmin() ? 'Administrator' : 'Pelanggan' }}</p>
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
                @else
                    <a href="{{ route('login') }}" class="hidden md:block text-xs font-semibold tracking-widest uppercase text-[#5C4033] hover:text-[#B8935A] transition-colors">Log In</a>
                    <a href="{{ route('register') }}" class="hidden md:block text-xs font-semibold tracking-widest uppercase text-white bg-[#B8935A] hover:bg-[#8C7B65] px-5 py-2.5 transition-colors">Daftar</a>
                @endauth

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
            <a href="{{ route('landing') }}" class="block px-2 py-2.5 text-sm text-[#5C4033] tracking-widest uppercase hover:text-[#B8935A] transition-colors">Beranda</a>
            @auth
                <a href="{{ route('customer.catalog.index') }}" class="block px-2 py-2.5 text-sm text-[#5C4033] tracking-widest uppercase hover:text-[#B8935A] transition-colors">Kamar</a>
                @if(auth()->user()->isCustomer())
                    <a href="{{ route('customer.dashboard') }}" class="block px-2 py-2.5 text-sm text-[#5C4033] tracking-widest uppercase hover:text-[#B8935A] transition-colors">Dashboard</a>
                    <a href="{{ route('customer.reservations.index') }}" class="block px-2 py-2.5 text-sm text-[#5C4033] tracking-widest uppercase hover:text-[#B8935A] transition-colors">Reservasi Saya</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-[#EDE8DC] mt-2">
                    @csrf
                    <button type="submit" class="text-sm text-[#8C7B65] tracking-widest uppercase px-2 py-2.5">Keluar</button>
                </form>
            @else
                <div class="pt-2 border-t border-[#EDE8DC] mt-2 flex flex-col gap-2 px-2">
                    <a href="{{ route('login') }}" class="text-sm text-[#5C4033] tracking-widest uppercase">Log In</a>
                    <a href="{{ route('register') }}" class="text-sm text-[#B8935A] tracking-widest uppercase font-semibold">Daftar</a>
                </div>
            @endauth
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

<main class="w-full">
    @yield('content')
</main>

<footer style="background-color: #2A1D14;" class="mt-16">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-12">
        {{-- Brand Row --}}
        <div class="text-center mb-8">
            <h3 class="text-2xl font-semibold text-white" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.03em;">
                Royal Crown <em class="text-[#D4B896] font-normal">Hotel</em>
            </h3>
            <p class="text-[#705F4A] text-xs tracking-[0.3em] uppercase mt-2" style="font-family: 'Montserrat', sans-serif;">Luxury Collection</p>
            {{-- Ornamental rule --}}
            <div class="flex items-center justify-center gap-4 mt-5">
                <div class="w-16 h-px" style="background: linear-gradient(to right, transparent, rgba(184,147,90,0.5));"></div>
                <span class="text-[#B8935A] text-xs">◆</span>
                <div class="w-16 h-px" style="background: linear-gradient(to left, transparent, rgba(184,147,90,0.5));"></div>
            </div>
        </div>
        <p class="text-[#4A3828] text-xs tracking-[0.2em] uppercase text-center" style="font-family: 'Montserrat', sans-serif;">
            &copy; {{ date('Y') }} Royal Crown Hotel &middot; Seluruh hak dilindungi
        </p>
    </div>
</footer>


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

@stack('scripts')
</body>
</html>
