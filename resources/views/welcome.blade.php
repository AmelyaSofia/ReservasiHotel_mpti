<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Crown Hotel | Luxury Collection</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FAF7F2] text-[#2A1D14] antialiased" style="font-family: 'Montserrat', sans-serif;">

    {{-- NAVBAR (TRANSPARENT ABSOLUTE) --}}
    <nav class="absolute top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-6 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex flex-col text-white group">
                <span class="text-2xl md:text-3xl font-semibold leading-none"
                    style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.03em;">
                    Royal Crown
                </span>
                <span
                    class="text-[0.6rem] tracking-[0.3em] uppercase text-[#B8935A] mt-1 group-hover:text-white transition-colors">
                    Luxury Collection
                </span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="#about"
                    class="text-xs font-medium tracking-[0.15em] uppercase text-white hover:text-[#B8935A] transition-colors">Tentang
                    Kami</a>
                <a href="#rooms"
                    class="text-xs font-medium tracking-[0.15em] uppercase text-white hover:text-[#B8935A] transition-colors">Kamar
                    & Suite</a>
                <a href="#facilities"
                    class="text-xs font-medium tracking-[0.15em] uppercase text-white hover:text-[#B8935A] transition-colors">Fasilitas</a>

                <div class="w-px h-4 bg-white/30"></div>

                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('customer.dashboard') }}"
                        class="text-xs font-semibold tracking-[0.15em] uppercase text-[#B8935A] hover:text-white transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-xs font-semibold tracking-[0.15em] uppercase text-white hover:text-[#B8935A] transition-colors">Log
                        In</a>
                @endauth
            </div>

            {{-- Mobile Menu Icon (Visual Only for simplicity on landing page) --}}
            <a href="{{ route('login') }}" class="md:hidden text-white hover:text-[#B8935A] transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </a>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="relative h-screen w-full flex items-center justify-center overflow-hidden">
        {{-- Background Image --}}
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-fixed transform scale-105"
            style="background-image: url('{{ asset('images/hotel-exterior.jpg') }}');"></div>

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0"
            style="background: linear-gradient(135deg, rgba(26,16,8,0.85) 0%, rgba(42,29,20,0.5) 50%, rgba(26,16,8,0.85) 100%);">
        </div>

        {{-- Content --}}
        <div class="relative z-10 text-center px-5 max-w-4xl mx-auto mt-16">
            <p
                class="text-xs md:text-sm text-[#B8935A] tracking-[0.3em] uppercase font-semibold mb-6 animate-fade-in-up">
                Selamat Datang di Royal Crown
            </p>
            <h1 class="text-5xl md:text-7xl font-light text-white leading-tight mb-8"
                style="font-family: 'Cormorant Garamond', serif; text-shadow: 0 4px 20px rgba(0,0,0,0.5);">
                Kemewahan Klasik <br> di Pusat Kota
            </h1>
            <div class="w-16 h-[1px] bg-[#B8935A] mx-auto my-8"></div>
            <p class="text-white/80 text-sm md:text-base mb-10 font-light max-w-2xl mx-auto leading-relaxed">
                Nikmati pengalaman menginap eksklusif dengan pelayanan bintang lima dan kenyamanan tanpa kompromi.
            </p>
            <a href="{{ auth()->check() ? route('customer.catalog.index') : route('login') }}"
                class="inline-block bg-[#B8935A] text-white px-8 py-3.5 text-xs font-semibold tracking-widest uppercase hover:bg-[#8C7B65] transition-colors shadow-lg">
                Mulai Reservasi
            </a>
        </div>
    </section>

    {{-- ABOUT SECTION --}}
    <section id="about" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <img src="{{ asset('images/hotel-lobby.jpg') }}" alt="Royal Crown Lobby"
                        class="w-full h-auto shadow-2xl border border-[#EDE8DC] p-2">
                    <div
                        class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#FAF7F2] border border-[#B8935A]/30 hidden md:flex items-center justify-center flex-col shadow-xl z-10">
                        <span class="text-2xl font-light text-[#B8935A]"
                            style="font-family: 'Cormorant Garamond', serif;">5★</span>
                        <span
                            class="text-[8px] uppercase tracking-[0.2em] text-[#5C4033] mt-1 font-medium text-center leading-tight">Bintang<br>Lima</span>
                    </div>
                </div>
                <div class="lg:pl-8">
                    <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4 font-semibold">Tentang Kami</p>
                    <h2 class="text-4xl font-light text-[#2A1D14] mb-6 leading-tight"
                        style="font-family: 'Cormorant Garamond', serif;">
                        Dedikasi Terhadap <br>
                        <span class="italic text-[#5C4033]">Kenyamanan Anda</span>
                    </h2>
                    <p class="text-[#8C7B65] text-sm leading-relaxed mb-6">
                        Berdiri sejak 1990, Royal Crown Hotel telah menjadi simbol kemewahan dan keramahtamahan. Kami
                        memadukan keanggunan desain klasik eropa dengan fasilitas modern yang tak tertandingi.
                    </p>
                    <p class="text-[#8C7B65] text-sm leading-relaxed mb-10">
                        Setiap detail, mulai dari lobi yang memukau hingga kamar-kamar yang ditata apik, dirancang
                        khusus untuk memastikan pengalaman menginap Anda layaknya seorang bangsawan.
                    </p>

                    <div class="grid grid-cols-2 gap-8 border-t border-[#EDE8DC] pt-8">
                        <div>
                            <p class="text-3xl text-[#2A1D14] mb-2" style="font-family: 'Cormorant Garamond', serif;">
                                24/7</p>
                            <p class="text-[10px] uppercase tracking-widest text-[#A89880] font-semibold">Layanan
                                Concierge</p>
                        </div>
                        <div>
                            <p class="text-3xl text-[#2A1D14] mb-2" style="font-family: 'Cormorant Garamond', serif;">
                                100+</p>
                            <p class="text-[10px] uppercase tracking-widest text-[#A89880] font-semibold">Kamar & Suite
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KAMAR & SUITE SECTION --}}
    <section id="rooms" class="py-24 bg-[#FAF7F2] border-y border-[#EDE8DC]">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-16">
                <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4 font-semibold">Akomodasi</p>
                <h2 class="text-4xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">
                    Pilihan Kamar & Suite
                </h2>
                <div class="flex items-center justify-center gap-4 mt-6">
                    <div class="w-16 h-px"
                        style="background: linear-gradient(to right, transparent, rgba(184,147,90,0.5));"></div>
                    <span class="text-[#B8935A] text-xs">◆</span>
                    <div class="w-16 h-px"
                        style="background: linear-gradient(to left, transparent, rgba(184,147,90,0.5));"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($roomTypes->take(3) as $index => $type)
                    @php
                        $firstRoom = $type->rooms->whereNotNull('image')->first();
                        $imagePath = $firstRoom ? $firstRoom->image : null;

                        // Fallback placeholders for room variety
                        $placeholders = [
                            'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&q=80&w=1000', // elegant room
                            'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&q=80&w=1000', // bright room
                            'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&q=80&w=1000'  // suite
                        ];
                        $fallbackImage = $placeholders[$index % count($placeholders)];
                    @endphp
                    <div
                        class="bg-white border border-[#EDE8DC] flex flex-col hover:shadow-2xl transition-all duration-300 group">
                        {{-- Gambar --}}
                        <div class="relative h-64 overflow-hidden border-b border-[#EDE8DC]">
                            @if($imagePath && Storage::disk('public')->exists($imagePath))
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $type->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                {{-- Fallback image --}}
                                <img src="{{ $fallbackImage }}" alt="{{ $type->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                            <h3 class="absolute bottom-5 left-6 text-white text-2xl font-light tracking-wide"
                                style="font-family: 'Cormorant Garamond', serif;">{{ $type->name }}</h3>
                        </div>

                        {{-- Konten --}}
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-[#8C7B65] text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                                {{ $type->description ?: 'Nikmati kenyamanan beristirahat di ruangan dengan sentuhan desain interior eksklusif dan fasilitas lengkap bintang lima.' }}
                            </p>

                            <div class="border-t border-[#EDE8DC] pt-5 flex items-end justify-between">
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-[#A89880] mb-1 font-medium">Mulai
                                        dari</p>
                                    @php
                                        $activeRate = $type->active_seasonal_rate;
                                    @endphp
                                    @if($activeRate)
                                        <p class="text-xs text-[#A89880] line-through mb-1"
                                            style="font-family: 'Montserrat', sans-serif;">
                                            Rp {{ number_format($type->price_per_night, 0, ',', '.') }}
                                        </p>
                                        <div class="flex items-end gap-1.5">
                                            <p class="text-lg font-semibold text-[#8C2323] leading-none"
                                                style="font-family: 'Montserrat', sans-serif;">
                                                Rp {{ number_format($activeRate->price_per_night, 0, ',', '.') }}
                                            </p>
                                            <span class="text-xs text-[#A89880] mb-0"
                                                style="font-family: 'Montserrat', sans-serif;">/malam</span>
                                            <span
                                                class="bg-[#8C2323] text-white text-[9px] px-1.5 py-0.5 rounded uppercase tracking-wider mb-0.5 ml-1"
                                                style="font-family: 'Montserrat', sans-serif;">Promo</span>
                                        </div>
                                    @else
                                        <div class="flex items-end gap-1.5">
                                            <p class="text-lg font-semibold text-[#B8935A] leading-none"
                                                style="font-family: 'Montserrat', sans-serif;">
                                                Rp {{ number_format($type->price_per_night, 0, ',', '.') }}
                                            </p>
                                            <span class="text-xs text-[#A89880] mb-0"
                                                style="font-family: 'Montserrat', sans-serif;">/malam</span>
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ auth()->check() ? route('customer.catalog.index') : route('login') }}"
                                    class="text-[10px] font-semibold uppercase tracking-widest text-[#5C4033] hover:text-[#B8935A] transition-colors flex items-center gap-1">
                                    Lihat
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-16">
                <a href="{{ auth()->check() ? route('customer.catalog.index') : route('login') }}"
                    class="inline-block border border-[#B8935A] text-[#B8935A] px-8 py-3 text-xs font-semibold uppercase tracking-widest hover:bg-[#B8935A] hover:text-white transition-colors">
                    Jelajahi Semua Kamar
                </a>
            </div>
        </div>
    </section>

    {{-- FASILITAS SECTION --}}
    <section id="facilities" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-16">
                <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4 font-semibold">Layanan Premium</p>
                <h2 class="text-4xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">
                    Fasilitas Tersedia
                </h2>
                <div class="flex items-center justify-center gap-4 mt-6">
                    <div class="w-16 h-px"
                        style="background: linear-gradient(to right, transparent, rgba(184,147,90,0.5));"></div>
                    <span class="text-[#B8935A] text-xs">◆</span>
                    <div class="w-16 h-px"
                        style="background: linear-gradient(to left, transparent, rgba(184,147,90,0.5));"></div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($facilities->take(8) as $fac)
                    @php
                        $name = strtolower($fac->name);

                        // Default Star SVG
                        $svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />';

                        if (str_contains($name, 'wifi')) {
                            $svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />';
                        } elseif (str_contains($name, 'ac ') || str_contains($name, 'air conditioner')) {
                            $svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /><path stroke-linecap="round" stroke-linejoin="round" d="M5 5h14c1.105 0 2 .895 2 2v4c0 1.105-.895 2-2 2H5c-1.105 0-2-.895-2-2V7c0-1.105.895-2 2-2z" />';
                        } elseif (str_contains($name, 'tv') || str_contains($name, 'led')) {
                            $svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />';
                        } elseif (str_contains($name, 'kulkas') || str_contains($name, 'mini')) {
                            $svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 3v18M19 3v18M5 10h14M8 6h2M8 14h2M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />';
                        } elseif (str_contains($name, 'brankas')) {
                            $svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />';
                        } elseif (str_contains($name, 'kamar mandi') || str_contains($name, 'air panas') || str_contains($name, 'bathtub')) {
                            $svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h10a4 4 0 004-4M3 15v-4M21 15v-4M8 7V3h8v4m-5 4h2" />';
                        } elseif (str_contains($name, 'balkon')) {
                            $svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M4 21V5a2 2 0 012-2h12a2 2 0 012 2v16M9 9h6M9 13h6M9 17h6" />';
                        } elseif (str_contains($name, 'meja')) {
                            $svg = '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M5 10v10m14-10v10M8 14h8" />';
                        }
                    @endphp
                    <div
                        class="bg-[#FAF7F2] border border-[#EDE8DC] p-8 flex flex-col items-center text-center group hover:bg-[#2A1D14] transition-colors duration-300 rounded-sm">
                        <div
                            class="w-16 h-16 rounded-full border border-[#B8935A]/30 flex items-center justify-center text-[#B8935A] bg-white group-hover:bg-[#B8935A] group-hover:text-white transition-colors duration-300 mb-5 shadow-sm">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                {!! $svg !!}
                            </svg>
                        </div>
                        <h3
                            class="text-xs font-semibold text-[#5C4033] tracking-widest uppercase group-hover:text-white transition-colors duration-300">
                            {{ $fac->name }}
                        </h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer style="background-color: #1A120C;" class="pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-b border-white/10 pb-16">
                {{-- Brand --}}
                <div>
                    <a href="{{ url('/') }}" class="flex flex-col text-white mb-6">
                        <span class="text-3xl font-semibold leading-none"
                            style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.03em;">
                            Royal Crown
                        </span>
                        <span class="text-[0.65rem] tracking-[0.3em] uppercase text-[#B8935A] mt-1">
                            Luxury Collection
                        </span>
                    </a>
                    <p class="text-[#A89880] text-sm leading-relaxed max-w-sm">
                        Simbol kemewahan dan kenyamanan sejati di pusat kota. Temukan pengalaman menginap yang tak
                        terlupakan bersama kami.
                    </p>
                </div>

                {{-- Kontak --}}
                <div>
                    <h4 class="text-white text-lg mb-6" style="font-family: 'Cormorant Garamond', serif;">Kontak Kami
                    </h4>
                    <ul class="space-y-4 text-sm text-[#A89880]">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 shrink-0 text-[#B8935A]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Jl. Jend. Sudirman No. 123, Jakarta, Indonesia
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0 text-[#B8935A]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            +62 21 5555 7777
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0 text-[#B8935A]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            info@royalcrown.com
                        </li>
                    </ul>
                </div>

                {{-- Tautan --}}
                <div>
                    <h4 class="text-white text-lg mb-6" style="font-family: 'Cormorant Garamond', serif;">Tautan Cepat
                    </h4>
                    <div class="flex flex-col gap-3 text-sm">
                        <a href="#about" class="text-[#A89880] hover:text-[#B8935A] transition-colors w-max">Tentang
                            Kami</a>
                        <a href="#rooms" class="text-[#A89880] hover:text-[#B8935A] transition-colors w-max">Kamar &
                            Suite</a>
                        <a href="#facilities"
                            class="text-[#A89880] hover:text-[#B8935A] transition-colors w-max">Fasilitas</a>
                        <a href="{{ route('login') }}"
                            class="text-[#A89880] hover:text-[#B8935A] transition-colors w-max">Member Login</a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <p class="text-[#705F4A] text-xs tracking-[0.2em] uppercase"
                    style="font-family: 'Montserrat', sans-serif;">
                    &copy; {{ date('Y') }} Royal Crown Hotel &middot; Seluruh hak dilindungi
                </p>
            </div>
        </div>
    </footer>

</body>

</html>