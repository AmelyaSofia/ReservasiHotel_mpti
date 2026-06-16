@extends('layouts.customer')

@section('title', 'Koleksi Kamar')

@section('content')

{{-- ════════════════════════════════════════ HERO HEADER ════ --}}
<div class="relative overflow-hidden mb-10" style="min-height: 200px;">
    {{-- Hotel exterior photo --}}
    <div class="absolute inset-0"
         style="background-image: url('/images/hotel-exterior.jpg'); background-size: cover; background-position: center 60%;">
    </div>
    {{-- Overlay --}}
    <div class="absolute inset-0"
         style="background: linear-gradient(135deg, rgba(26,16,8,0.86) 0%, rgba(42,29,20,0.72) 60%, rgba(26,16,8,0.68) 100%);">
    </div>
    <div class="absolute top-5 left-5 w-10 h-10 border-t border-l hidden sm:block" style="border-color: rgba(184,147,90,0.5);"></div>
    <div class="absolute top-5 right-5 w-10 h-10 border-t border-r hidden sm:block" style="border-color: rgba(184,147,90,0.5);"></div>
    <div class="absolute bottom-5 left-5 w-10 h-10 border-b border-l hidden sm:block" style="border-color: rgba(184,147,90,0.5);"></div>
    <div class="absolute bottom-5 right-5 w-10 h-10 border-b border-r hidden sm:block" style="border-color: rgba(184,147,90,0.5);"></div>

    <div class="relative px-8 sm:px-14 py-14">
        <p class="text-xs text-[#C9A96E] tracking-[0.25em] uppercase font-semibold mb-3">Luxury Living</p>
        <h1 class="text-3xl sm:text-4xl font-semibold text-white" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em; text-shadow: 0 2px 12px rgba(0,0,0,0.4);">
            Koleksi Kamar Kami
        </h1>
        <div class="w-10 h-0.5 bg-[#B8935A] my-4"></div>
        <p class="text-white/65 text-sm max-w-xl leading-relaxed">
            Rasakan perpaduan sempurna keanggunan klasik dan kenyamanan modern di setiap sudut suite eksklusif kami.
        </p>
    </div>
</div>


{{-- ════════════════════════════════════════ FILTERS ════ --}}
<div class="card-luxury p-6 mb-8 bg-white">
    <form action="{{ route('customer.catalog.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-5 items-end">
        {{-- Filter Tipe Kamar --}}
        <div>
            <label for="room_type_id" class="form-label">Tipe Kamar</label>
            <select name="room_type_id" id="room_type_id" class="form-input-box py-2.5">
                <option value="">-- Semua Tipe Kamar --</option>
                @foreach($roomTypes as $type)
                    <option value="{{ $type->id }}" {{ request('room_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Filter Harga Maksimum --}}
        <div>
            <label for="max_price" class="form-label">Harga Maksimal Per Malam</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs text-[#8C7B65] font-semibold">Rp</span>
                <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" min="0" step="50000"
                       class="form-input-box py-2.5 pl-8" placeholder="Contoh: 1000000">
            </div>
        </div>

        {{-- Filter Buttons --}}
        <div class="flex gap-3">
            <button type="submit" class="flex-1 btn-primary py-2.5 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c.132 0 .263 0 .393.007a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1-8.313-12.454Z"/>
                </svg>
                Terapkan Filter
            </button>
            @if(request()->filled('room_type_id') || request()->filled('max_price'))
                <a href="{{ route('customer.catalog.index') }}" class="btn-outline py-2.5 px-4 flex items-center justify-center text-xs" title="Reset Filter">
                    Reset
                </a>
            @endif
        </div>
    </form>
</div>

{{-- ════════════════════════════════════════ ROOM GRID ════ --}}
@if($rooms->isEmpty())
    <div class="card-luxury py-20 flex flex-col items-center justify-center text-[#A89880]">
        <div class="w-12 h-px bg-[#DDD5C5] mb-6"></div>
        <svg class="w-12 h-12 opacity-30 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.143 17.082a24.248 24.248 0 0 0 3.844.148m-3.844-.148a23.856 23.856 0 0 1-5.455-1.31M8.976 10.538A20.36 20.36 0 0 1 3 10.027m0 0a20.084 20.084 0 0 0 6 1.157m-6-1.157L5.25 9.75m16.5 1.5c.346-.358.683-.736 1.011-1.134a1.002 1.002 0 0 0-.2-1.42l-5.247-4.08A2.99 2.99 0 0 0 14.5 2H9.5a2.99 2.99 0 0 0-2.814 2.116L1.44 8.216a1.002 1.002 0 0 0-.2 1.42c.328.398.665.776 1.011 1.134m19.5 0a24.254 24.254 0 0 1-3.844.148m3.844-.148a23.856 23.856 0 0 0-5.455-1.31m-3.844 1.458a24.28 24.28 0 0 0 3.844-.148m-3.844.148a23.856 23.856 0 0 1-5.455-1.31m6.037-2.143a20.36 20.36 0 0 1 5.976-.511m0 0a20.083 20.083 0 0 0-5.976-1.157"/>
        </svg>
        <p class="text-sm tracking-wider font-semibold uppercase">Tidak Ada Kamar yang Cocok</p>
        <p class="text-xs text-[#8C7B65] mt-2">Coba sesuaikan pilihan filter Anda atau bersihkan pencarian.</p>
        <a href="{{ route('customer.catalog.index') }}" class="mt-4 text-xs text-[#B8935A] tracking-widest uppercase hover:underline">
            Tampilkan Semua Kamar
        </a>
        <div class="w-12 h-px bg-[#DDD5C5] mt-6"></div>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($rooms as $room)
            <div class="card-luxury flex flex-col justify-between overflow-hidden group hover:border-[#D4B896] hover:shadow-md transition-all duration-300">
                
                {{-- Room Photo Area --}}
                <div class="relative w-full aspect-[4/3] bg-[#EDE8DC] overflow-hidden">
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="Kamar {{ $room->room_number }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-[#8C7B65]">
                            <svg class="w-12 h-12 opacity-30 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1.091m-18.75 0l3-1.091m0 0V9m0 0L9 5.454m9 1.636V9m-9-3.545L20.25 9m-11-3.545V21"/>
                            </svg>
                            <span class="text-[10px] tracking-widest uppercase font-semibold text-[#A89880]">Foto Kamar</span>
                        </div>
                    @endif
                    
                    {{-- Floating price tag --}}
                    <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur-sm border border-[#EDE8DC] px-3.5 py-1.5 shadow-sm">
                        <p class="text-[10px] text-[#8C7B65] tracking-widest uppercase leading-none mb-1">Mulai dari</p>
                        @php
                            $activeRate = $room->roomType->active_seasonal_rate;
                        @endphp
                        @if($activeRate)
                            <p class="text-[11px] text-[#A89880] line-through leading-none mb-1">
                                Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}
                            </p>
                            <p class="text-sm font-semibold text-[#8C2323] leading-none flex items-center gap-1">
                                Rp {{ number_format($activeRate->price_per_night, 0, ',', '.') }}<span class="text-[10px] text-[#A89880] font-normal font-sans">/malam</span>
                                <span class="bg-[#8C2323] text-white text-[8px] px-1 py-0.5 rounded uppercase tracking-wider font-sans">Promo</span>
                            </p>
                        @else
                            <p class="text-sm font-semibold text-[#2A1D14] leading-none">
                                Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}<span class="text-[10px] text-[#A89880] font-normal font-sans">/malam</span>
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Room Info Area --}}
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        {{-- Title & Type --}}
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div>
                            <p class="text-[10px] text-[#B8935A] tracking-[0.2em] uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">{{ $room->roomType->name }}</p>
                                <h3 class="text-lg font-semibold text-[#2A1D14] group-hover:text-[#B8935A] transition-colors mt-0.5" style="font-family: 'Cormorant Garamond', serif;">
                                    Suite {{ $room->room_number }}
                                </h3>
                            </div>
                            <div class="flex items-center gap-1 text-[11px] text-[#8C7B65] border border-[#EDE8DC] px-2 py-0.5">
                                <svg class="w-3 h-3 text-[#B8935A]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                                <span>{{ $room->capacity }} Orang</span>
                            </div>
                        </div>

                        {{-- Description --}}
                        <p class="text-xs text-[#8C7B65] line-clamp-2 leading-relaxed mb-4">
                            {{ $room->description }}
                        </p>

                        {{-- Facilities --}}
                        <div class="border-t border-[#F7F4EE] pt-3.5 mb-5">
                            <div class="flex flex-wrap gap-1">
                                @forelse($room->facilities->take(3) as $fac)
                                    <span class="text-[9px] bg-[#F7F4EE] text-[#705F4A] px-2 py-0.5 tracking-wide border border-transparent">
                                        {{ $fac->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-[#A89880] italic">Fasilitas standar</span>
                                @endforelse
                                @if($room->facilities->count() > 3)
                                    <span class="text-[9px] text-[#A89880] px-1.5 py-0.5 font-semibold">
                                        +{{ $room->facilities->count() - 3 }} Lainnya
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-2 border-t border-[#EDE8DC] pt-4">
                        <a href="{{ route('customer.catalog.show', $room) }}" class="flex-1 btn-outline py-2 text-center text-xs tracking-wider">
                            Rincian Detail
                        </a>
                        <a href="{{ route('customer.reservations.create', $room) }}" class="flex-1 btn-primary py-2 text-center text-xs tracking-wider">
                            Pesan Kamar
                        </a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($rooms->hasPages())
        <div class="px-6 py-5 border border-[#EDE8DC] bg-white flex items-center justify-between">
            <div class="text-xs text-[#8C7B65]">
                Menampilkan {{ $rooms->firstItem() }} hingga {{ $rooms->lastItem() }} dari {{ $rooms->total() }} kamar hotel
            </div>
            <div>
                {{ $rooms->links() }}
            </div>
        </div>
    @endif
@endif

@endsection
