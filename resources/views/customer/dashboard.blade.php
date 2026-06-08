@extends('layouts.customer')

@section('title', 'Beranda')

@section('content')

{{-- ════════════════════════════════════════ HERO GREETING ════ --}}
<div class="relative overflow-hidden mb-10" style="min-height: 220px;">

    {{-- Hotel lobby photo background --}}
    <div class="absolute inset-0"
         style="background-image: url('/images/hotel-lobby.jpg'); background-size: cover; background-position: center 30%;">
    </div>

    {{-- Dark gradient overlay --}}
    <div class="absolute inset-0"
         style="background: linear-gradient(135deg, rgba(26,16,8,0.88) 0%, rgba(42,29,20,0.75) 60%, rgba(26,16,8,0.70) 100%);">
    </div>

    {{-- Corner ornaments --}}
    <div class="absolute top-5 left-5 w-10 h-10 border-t border-l hidden sm:block" style="border-color: rgba(184,147,90,0.5);"></div>
    <div class="absolute top-5 right-5 w-10 h-10 border-t border-r hidden sm:block" style="border-color: rgba(184,147,90,0.5);"></div>
    <div class="absolute bottom-5 left-5 w-10 h-10 border-b border-l hidden sm:block" style="border-color: rgba(184,147,90,0.5);"></div>
    <div class="absolute bottom-5 right-5 w-10 h-10 border-b border-r hidden sm:block" style="border-color: rgba(184,147,90,0.5);"></div>

    <div class="relative px-8 sm:px-14 py-14 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <div>
            <p class="text-xs text-[#C9A96E] tracking-[0.25em] uppercase font-semibold mb-3">Selamat Datang Kembali</p>
            <h1 class="text-3xl sm:text-4xl font-semibold text-white leading-tight" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em; text-shadow: 0 2px 12px rgba(0,0,0,0.4);">
                {{ auth()->user()->name }}
            </h1>
            <div class="w-10 h-0.5 bg-[#B8935A] my-4"></div>
            <p class="text-white/65 text-sm">
                Nikmati pengalaman menginap yang tak terlupakan bersama kami
            </p>
        </div>
        <a href="{{ route('customer.catalog.index') }}"
            class="btn-ghost-light shrink-0">
            Lihat Kamar
        </a>
    </div>
</div>


{{-- ══════════════════════════════════════════ STAT CARDS ════ --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
    @php
        $statCards = [
            ['label' => 'Total Reservasi', 'value' => $stats['total'],     'color' => '#2A1D14'],
            ['label' => 'Menunggu',        'value' => $stats['pending'],   'color' => '#B8935A'],
            ['label' => 'Dikonfirmasi',    'value' => $stats['confirmed'], 'color' => '#5C4033'],
            ['label' => 'Selesai',         'value' => $stats['completed'], 'color' => '#3D2B1F'],
        ];
    @endphp
    @foreach($statCards as $sc)
    <div class="card-luxury p-6 text-center">
        <p class="text-3xl font-semibold" style="color: {{ $sc['color'] }};">
            {{ $sc['value'] }}
        </p>
        <div class="flex items-center justify-center gap-2 my-2">
            <div class="w-4 h-px bg-[#DDD5C5]"></div>
            <span class="text-[#B8935A] text-[8px]">◆</span>
            <div class="w-4 h-px bg-[#DDD5C5]"></div>
        </div>
        <p class="text-xs text-[#A89880] tracking-[0.15em] uppercase" style="font-family: 'Montserrat', sans-serif;">{{ $sc['label'] }}</p>
    </div>
    @endforeach
</div>

{{-- ═══════════════════ RESERVASI TERBARU + SIDEBAR ════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Reservasi Terbaru --}}
    <div class="lg:col-span-2 card-luxury overflow-hidden">
        <div class="flex items-end justify-between px-6 py-5 border-b border-[#EDE8DC]">
            <div>
                <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Aktivitas</p>
                <h2 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">
                    Reservasi Terbaru
                </h2>
            </div>
            <a href="{{ route('customer.reservations.index') }}"
                class="text-xs text-[#B8935A] tracking-widest uppercase hover:text-[#9E7A42] flex items-center gap-1.5 transition-colors">
                Lihat semua
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($reservasiTerbaru->isEmpty())
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-20">
                <div class="w-10 h-px bg-[#DDD5C5] mb-8"></div>
                <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-2">Belum Ada Reservasi</p>
                <p class="text-base text-[#8C7B65] mb-8 text-center max-w-xs">
                    Mulailah pengalaman menginap Anda yang pertama bersama Royal Crown Hotel
                </p>
                <a href="{{ route('customer.catalog.index') }}" class="btn-primary text-xs px-8 py-3">
                    Jelajahi Kamar
                </a>
                <div class="w-10 h-px bg-[#DDD5C5] mt-8"></div>
            </div>
        @else
            <div>
                @foreach($reservasiTerbaru as $i => $reservasi)
                <div class="flex items-center gap-5 px-6 py-4 border-b border-[#EDE8DC] last:border-0 hover:bg-[#FDFCF8] transition-colors group">

                    {{-- Number --}}
                    <div class="w-7 h-7 flex items-center justify-center text-xs font-medium text-[#A89880] border border-[#EDE8DC] shrink-0">
                        {{ $i + 1 }}
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="text-sm font-medium text-[#2A1D14]">Kamar {{ $reservasi->room->room_number }}</p>
                            <span class="text-[#DDD5C5]">·</span>
                            <p class="text-xs text-[#A89880]">{{ $reservasi->room->roomType->name }}</p>
                        </div>
                        <p class="text-xs text-[#A89880] mt-0.5 tracking-wide">
                            {{ $reservasi->check_in_date->format('d M') }} —
                            {{ $reservasi->check_out_date->format('d M Y') }}
                            · {{ $reservasi->nights }} malam
                        </p>
                    </div>

                    {{-- Right --}}
                    <div class="text-right shrink-0">
                        @php
                            $bm = ['pending'=>'badge-pending','confirmed'=>'badge-confirmed','completed'=>'badge-completed','cancelled'=>'badge-cancelled'];
                            $lm = ['pending'=>'Pending','confirmed'=>'Dikonfirmasi','completed'=>'Selesai','cancelled'=>'Dibatalkan'];
                        @endphp
                        <span class="badge {{ $bm[$reservasi->status] ?? '' }}">
                            {{ $lm[$reservasi->status] ?? $reservasi->status }}
                        </span>
                        <p class="text-xs font-medium text-[#2A1D14] mt-1.5">
                            Rp {{ number_format($reservasi->total_price, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Arrow --}}
                    <a href="{{ route('customer.reservations.show', $reservasi) }}"
                       class="opacity-0 group-hover:opacity-100 transition-opacity shrink-0">
                        <svg class="w-4 h-4 text-[#B8935A]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Sidebar --}}
    <div class="space-y-5">

        {{-- Profil --}}
        <div class="card-luxury p-6">
            <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4">Profil Saya</p>

            <div class="flex flex-col items-center text-center mb-5">
                <div class="w-14 h-14 flex items-center justify-center text-white text-xl font-semibold mb-3"
                     style="font-family: 'Cormorant Garamond', serif; background-color: #B8935A;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <p class="font-medium text-[#2A1D14] text-sm">{{ auth()->user()->name }}</p>
                <p class="text-xs text-[#A89880] mt-0.5">{{ auth()->user()->email }}</p>
            </div>

            <div class="border-t border-[#EDE8DC] pt-4">
                <div class="flex items-center justify-center gap-2">
                    <div class="w-1.5 h-1.5 bg-[#B8935A]"></div>
                    <p class="text-xs text-[#8C7B65] tracking-widest uppercase">Pelanggan Aktif</p>
                </div>
            </div>
        </div>

        {{-- Panduan --}}
        <div class="card-luxury p-6">
            <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4">Panduan</p>
            <h3 class="text-lg font-light text-[#2A1D14] mb-5" style="font-family: 'Cormorant Garamond', serif;">
                Cara Reservasi
            </h3>

            <div class="space-y-5">
                @foreach([
                    ['num' => 'I',   'title' => 'Pilih Kamar',    'desc' => 'Jelajahi koleksi kamar premium kami'],
                    ['num' => 'II',  'title' => 'Atur Tanggal',   'desc' => 'Tentukan jadwal check-in & check-out'],
                    ['num' => 'III', 'title' => 'Konfirmasi',     'desc' => 'Admin akan memverifikasi dalam 1×24 jam'],
                ] as $step)
                <div class="flex items-start gap-4">
                    <div class="text-xs font-light text-[#B8935A] w-6 shrink-0 mt-0.5"
                         style="font-family: 'Cormorant Garamond', serif;">
                        {{ $step['num'] }}
                    </div>
                    <div class="flex-1 border-l border-[#EDE8DC] pl-4">
                        <p class="text-sm font-medium text-[#2A1D14]">{{ $step['title'] }}</p>
                        <p class="text-xs text-[#A89880] mt-0.5">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <a href="{{ route('customer.catalog.index') }}" class="btn-primary w-full mt-6 text-xs py-3 justify-center">
                Mulai Reservasi
            </a>
        </div>

    </div>
</div>

@endsection
