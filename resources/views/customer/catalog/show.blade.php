@extends('layouts.customer')

@section('title', 'Kamar ' . $room->room_number)

@section('content')

{{-- ════════════════════════ BREADCRUMBS & NAVIGATION ════ --}}
<div class="mb-6 flex items-center justify-between flex-wrap gap-4">
    <div class="flex items-center gap-2">
        <a href="{{ route('customer.dashboard') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Beranda
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <a href="{{ route('customer.catalog.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Kamar
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Suite {{ $room->room_number }}</span>
    </div>
    <a href="{{ route('customer.catalog.index') }}" class="text-xs text-[#B8935A] tracking-widest uppercase hover:text-[#9E7A42] transition-colors flex items-center gap-1.5 font-medium">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
        </svg>
        Kembali ke Galeri
    </a>
</div>

{{-- ════════════════════════ MAIN DETAILS LAYOUT ════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- LEFT COLUMN: ROOM DETAILS (2/3 width) --}}
    <div class="lg:col-span-2 space-y-6">
        
        {{-- Room Display Card --}}
        <div class="card-luxury overflow-hidden bg-white">
            {{-- Room Image --}}
            <div class="relative w-full aspect-video bg-[#EDE8DC]">
                @if($room->image)
                    <img src="{{ asset('storage/' . $room->image) }}" alt="Kamar {{ $room->room_number }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-[#8C7B65]">
                        <svg class="w-16 h-16 opacity-30 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1.091m-18.75 0l3-1.091m0 0V9m0 0L9 5.454m9 1.636V9m-9-3.545L20.25 9m-11-3.545V21"/>
                        </svg>
                        <p class="text-sm tracking-wider uppercase font-semibold text-[#A89880]">Foto Suite</p>
                    </div>
                @endif

                {{-- Status Float Tag --}}
                <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-1.5 border border-[#EDE8DC] shadow-sm">
                    <div class="flex items-center gap-1.5 text-xs text-[#5C4033] tracking-widest uppercase font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        <span>Siap Dipesan</span>
                    </div>
                </div>
            </div>

            {{-- Room Content --}}
            <div class="p-6 sm:p-8 space-y-6">
                <div>
                    <p class="text-xs text-[#B8935A] tracking-[0.25em] uppercase font-medium mb-1" style="font-family: 'Montserrat', sans-serif;">{{ $room->roomType->name }}</p>
                    <h2 class="text-2xl font-semibold text-[#2A1D14] mb-3" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.03em;">
                        Suite {{ $room->room_number }}
                    </h2>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-px bg-[#B8935A]/50"></div>
                        <span class="text-[#B8935A] text-xs">◆</span>
                        <div class="w-8 h-px bg-[#B8935A]/50"></div>
                    </div>
                    
                    <h4 class="text-xs font-medium text-[#8C7B65] uppercase tracking-[0.15em] mb-2.5" style="font-family: 'Montserrat', sans-serif;">Deskripsi Kamar</h4>
                    <p class="text-sm text-[#5C4033] leading-relaxed whitespace-pre-line">{{ $room->description }}</p>
                </div>

                {{-- Facilities --}}
                <div class="border-t border-[#EDE8DC] pt-6">
                    <h4 class="text-xs font-medium text-[#8C7B65] uppercase tracking-[0.15em] mb-4" style="font-family: 'Montserrat', sans-serif;">Fasilitas Suite Eksklusif</h4>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3.5">
                        @forelse($room->facilities as $fac)
                            <div class="flex items-center gap-2.5 px-4 py-3 border border-[#EDE8DC] bg-[#F7F4EE]/50 hover:bg-[#F7F4EE] hover:border-[#DDD5C5] transition-colors duration-200">
                                <div class="w-1.5 h-1.5 rounded-full bg-[#B8935A] shrink-0"></div>
                                <span class="text-xs font-medium text-[#5C4033] leading-none">{{ $fac->name }}</span>
                            </div>
                        @empty
                            <p class="text-xs text-[#A89880] italic col-span-full">Fasilitas standar bintang lima terpasang.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- RIGHT COLUMN: PRICING CARD & QUICK BOOK (1/3 width) --}}
    <div class="space-y-6">
        
        {{-- Booking spec --}}
        <div class="card-luxury p-6 bg-white space-y-6">
            <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 font-semibold">
                Rincian Tarif & Kamar
            </p>

            <div class="space-y-4">
                <div class="flex justify-between items-center border-b border-[#F7F4EE] pb-2.5">
                    <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Tarif Sewa</span>
                    <div class="text-right">
                        <p class="text-xl font-bold text-[#B8935A] font-serif">
                            Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}
                        </p>
                        <p class="text-[9px] text-[#A89880] tracking-widest uppercase mt-0.5">Per Malam</p>
                    </div>
                </div>
                <div class="flex justify-between items-center border-b border-[#F7F4EE] pb-2.5">
                    <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Kapasitas Maksimal</span>
                    <span class="text-sm font-semibold text-[#2A1D14]">{{ $room->capacity }} Orang</span>
                </div>
                <div class="flex justify-between items-center border-b border-[#F7F4EE] pb-2.5">
                    <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Tipe Bed</span>
                    <span class="text-sm font-semibold text-[#2A1D14]">King/Twin Size</span>
                </div>
                <div class="flex justify-between items-center pb-1">
                    <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Status Kamar</span>
                    <span class="text-xs font-bold text-emerald-700 tracking-wider uppercase bg-emerald-50 border border-emerald-200 px-2 py-0.5">Tersedia</span>
                </div>
            </div>

            <div class="border-t border-[#EDE8DC] pt-5">
                <a href="{{ route('customer.reservations.create', $room) }}" class="w-full btn-primary py-3.5 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Pesan Kamar Sekarang
                </a>
            </div>
        </div>

        {{-- Luxury Promise Card --}}
        <div class="card-luxury p-6 bg-[#2A1D14] text-white space-y-4">
            <p class="text-[10px] text-[#D4B896] tracking-[0.25em] uppercase" style="font-family: 'Montserrat', sans-serif;">Jaminan Kami</p>
            <h4 class="text-xl font-semibold text-white" style="font-family: 'Cormorant Garamond', serif;">Layanan Bintang Lima</h4>
            <div class="flex items-center gap-3">
                <div class="w-6 h-px bg-[#B8935A]"></div>
                <span class="text-[#B8935A] text-[8px]">◆</span>
                <div class="w-6 h-px bg-[#B8935A]/30"></div>
            </div>
            <div class="space-y-3 text-xs text-[#A89880] leading-relaxed">
                <p class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#B8935A] shrink-0"></span>
                    <span>Proses Check-in Cepat & Personal</span>
                </p>
                <p class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#B8935A] shrink-0"></span>
                    <span>Kebersihan Terjamin Standar Montserratnasional</span>
                </p>
                <p class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#B8935A] shrink-0"></span>
                    <span>Layanan Kamar 24 Jam Non-Stop</span>
                </p>
            </div>
        </div>
        
    </div>
</div>

@endsection
