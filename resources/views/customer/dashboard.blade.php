@extends('layouts.customer')

@section('title', 'Beranda')

@section('content')

{{-- ══════════════════════════════════════════ HERO / GREETING ════ --}}
<div class="relative bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 rounded-3xl overflow-hidden mb-8 p-8 md:p-10">

    {{-- Decorative circles --}}
    <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
    <div class="absolute -bottom-8 -left-8 w-36 h-36 bg-white/5 rounded-full blur-xl pointer-events-none"></div>

    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div>
            <div class="inline-flex items-center gap-2 bg-white/20 rounded-full px-3 py-1 mb-3">
                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                <span class="text-white/90 text-xs font-medium">Portal Pelanggan</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-white leading-tight">
                Halo, {{ auth()->user()->name }}! 👋
            </h1>
            <p class="text-blue-100 mt-2 text-sm md:text-base">
                Temukan kamar terbaik dan buat reservasi dengan mudah.
            </p>
        </div>
        <a href="{{ route('customer.catalog.index') }}"
            class="shrink-0 inline-flex items-center gap-2 bg-white text-blue-700 font-semibold text-sm px-6 py-3 rounded-2xl shadow-lg shadow-blue-900/30 hover:bg-blue-50 active:scale-95 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Cari Kamar
        </a>
    </div>
</div>

{{-- ══════════════════════════════════════════════ STAT CARDS ════ --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

    <div class="card p-5 text-center hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <p class="text-3xl font-bold text-slate-800">{{ $stats['total'] }}</p>
        <p class="text-xs text-slate-400 font-medium mt-1 uppercase tracking-wide">Total Reservasi</p>
    </div>

    <div class="card p-5 text-center hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <p class="text-3xl font-bold text-amber-500">{{ $stats['pending'] }}</p>
        <p class="text-xs text-slate-400 font-medium mt-1 uppercase tracking-wide">Menunggu</p>
    </div>

    <div class="card p-5 text-center hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <p class="text-3xl font-bold text-blue-600">{{ $stats['confirmed'] }}</p>
        <p class="text-xs text-slate-400 font-medium mt-1 uppercase tracking-wide">Dikonfirmasi</p>
    </div>

    <div class="card p-5 text-center hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <p class="text-3xl font-bold text-emerald-600">{{ $stats['completed'] }}</p>
        <p class="text-xs text-slate-400 font-medium mt-1 uppercase tracking-wide">Selesai</p>
    </div>
</div>

{{-- ════════════════════════════════ RESERVASI TERBARU + CTA ════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Reservasi Terbaru --}}
    <div class="lg:col-span-2 card overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h2 class="font-semibold text-slate-800">Reservasi Terbaru</h2>
            <a href="{{ route('customer.reservations.index') }}"
                class="text-xs font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                Lihat semua
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @if($reservasiTerbaru->isEmpty())
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-16 text-slate-400">
                <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-slate-500">Belum ada reservasi</p>
                <p class="text-xs text-slate-400 mt-1">Mulai pesan kamar pertama Anda sekarang</p>
                <a href="{{ route('customer.catalog.index') }}" class="btn-primary mt-4 text-sm">
                    Jelajahi Kamar
                </a>
            </div>
        @else
            <div class="divide-y divide-slate-100">
                @foreach($reservasiTerbaru as $reservasi)
                <div class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50/60 transition-colors">
                    {{-- Icon --}}
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                        </svg>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="text-sm font-semibold text-slate-800">
                                Kamar {{ $reservasi->room->room_number }}
                            </p>
                            <span class="text-slate-300">·</span>
                            <p class="text-xs text-slate-500">{{ $reservasi->room->roomType->name }}</p>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $reservasi->check_in_date->format('d M') }} –
                            {{ $reservasi->check_out_date->format('d M Y') }}
                            · {{ $reservasi->nights }} malam
                        </p>
                    </div>

                    {{-- Right --}}
                    <div class="text-right shrink-0">
                        @php
                            $badges = [
                                'pending'   => 'badge-pending',
                                'confirmed' => 'badge-confirmed',
                                'completed' => 'badge-completed',
                                'cancelled' => 'badge-cancelled',
                            ];
                            $labels = [
                                'pending'   => 'Pending',
                                'confirmed' => 'Dikonfirmasi',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ];
                        @endphp
                        <span class="badge {{ $badges[$reservasi->status] ?? '' }}">
                            {{ $labels[$reservasi->status] ?? $reservasi->status }}
                        </span>
                        <p class="text-xs font-semibold text-slate-700 mt-1">
                            Rp {{ number_format($reservasi->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Sidebar: Info + Bantuan --}}
    <div class="space-y-5">

        {{-- Info Akun --}}
        <div class="card p-5">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Profil Saya</h3>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center text-white text-xl font-bold shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-slate-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-emerald-50 rounded-xl px-3 py-2">
                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                <span class="text-xs text-emerald-700 font-medium">Akun aktif · Pelanggan</span>
            </div>
        </div>

        {{-- Panduan Reservasi --}}
        <div class="card p-5">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Cara Reservasi</h3>
            <ol class="space-y-3">
                @foreach([
                    ['icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z', 'title' => 'Cari Kamar', 'desc' => 'Jelajahi katalog kamar tersedia'],
                    ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'title' => 'Pilih Tanggal', 'desc' => 'Tentukan check-in & check-out'],
                    ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Konfirmasi', 'desc' => 'Tunggu persetujuan admin'],
                ] as $i => $step)
                <li class="flex items-start gap-3">
                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-blue-600">{{ $i + 1 }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-700">{{ $step['title'] }}</p>
                        <p class="text-xs text-slate-400">{{ $step['desc'] }}</p>
                    </div>
                </li>
                @endforeach
            </ol>

            <a href="{{ route('customer.catalog.index') }}"
                class="btn-primary w-full mt-5 text-sm justify-center">
                Mulai Reservasi
            </a>
        </div>

    </div>
</div>

@endsection
