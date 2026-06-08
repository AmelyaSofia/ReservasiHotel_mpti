@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('breadcrumb', 'Ringkasan data hotel secara keseluruhan')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="flex items-end justify-between mb-8">
    <div>
        <p class="text-xs text-[#B8935A] tracking-[0.3em] uppercase mb-2">Panel Administrasi</p>
        <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
            Selamat Datang, {{ auth()->user()->name }}
        </h2>
        <div class="gold-line mt-3"></div>
    </div>
    <p class="text-xs text-[#A89880] tracking-wider hidden sm:block">
        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
    </p>
</div>

{{-- ════════════════════════════ STAT CARDS ════ --}}
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

    @php
        $cards = [
            ['label' => 'Total Kamar',   'value' => $stats['total_kamar'],      'sub' => 'Unit terdaftar',      'icon' => 'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z'],
            ['label' => 'Tersedia',      'value' => $stats['kamar_tersedia'],    'sub' => 'Siap dipesan',        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label' => 'Terisi',        'value' => $stats['kamar_terisi'],      'sub' => 'Sedang digunakan',    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ['label' => 'Pelanggan',     'value' => $stats['total_pelanggan'],   'sub' => 'Terdaftar',           'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
        ];
    @endphp

    @foreach($cards as $card)
    <div class="stat-card group hover:border-[#D4B896] transition-colors duration-300">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-[#A89880] text-xs tracking-widest uppercase">{{ $card['label'] }}</p>
                <p class="text-3xl font-semibold text-[#2A1D14] mt-2">
                    {{ $card['value'] }}
                </p>
            </div>
            <svg class="w-5 h-5 text-[#C9A96E] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/>
            </svg>
        </div>
        <div class="flex items-center gap-2">
            <div class="w-6 h-px bg-[#B8935A]"></div>
            <p class="text-xs text-[#A89880]">{{ $card['sub'] }}</p>
        </div>
    </div>
    @endforeach
</div>

{{-- ══════════════════════ MIDDLE ROW ════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">

    {{-- Status Reservasi --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Reservasi</p>
        <h3 class="text-xl font-light text-[#2A1D14] mb-5" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Status Pemesanan</h3>

        @php
            $total = max($stats['total_reservasi'], 1);
            $items = [
                ['label' => 'Pending',       'value' => $stats['reservasi_pending'],   'color' => '#B8935A'],
                ['label' => 'Dikonfirmasi',  'value' => $stats['reservasi_confirmed'], 'color' => '#5C4033'],
                ['label' => 'Total',         'value' => $stats['total_reservasi'],     'color' => '#2A1D14'],
            ];
        @endphp

        <div class="space-y-4">
            @foreach($items as $item)
            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <span class="text-xs text-[#8C7B65] tracking-wider uppercase">{{ $item['label'] }}</span>
                    <span class="text-sm font-medium text-[#2A1D14]">{{ $item['value'] }}</span>
                </div>
                @if($item['label'] !== 'Total')
                <div class="h-px bg-[#EDE8DC]">
                    <div class="h-px transition-all duration-700"
                         style="width: {{ round($item['value'] / $total * 100) }}%; background-color: {{ $item['color'] }};"></div>
                </div>
                @else
                <div class="h-px bg-[#DDD5C5]"></div>
                @endif
            </div>
            @endforeach
        </div>

        <a href="{{ route('admin.reservations.index') }}"
            class="mt-5 inline-flex items-center gap-2 text-xs text-[#B8935A] tracking-widest uppercase hover:text-[#9E7A42] transition-colors">
            Lihat semua
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- Occupancy --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Kamar</p>
        <h3 class="text-xl font-light text-[#2A1D14] mb-5" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Tingkat Hunian</h3>

        @php
            $totalK = max($stats['total_kamar'], 1);
            $occupancy = round($stats['kamar_terisi'] / $totalK * 100);
        @endphp

        {{-- Circular-style percentage --}}
        <div class="flex items-center gap-6 mb-5">
            <div class="text-center">
                <p class="text-4xl font-semibold text-[#2A1D14]">{{ $occupancy }}%</p>
                <p class="text-xs text-[#A89880] tracking-wider mt-1">Tingkat Hunian</p>
            </div>
            <div class="flex-1 space-y-2">
                <div class="flex justify-between text-xs">
                    <span class="text-[#8C7B65] tracking-wider">Tersedia</span>
                    <span class="text-[#2A1D14] font-medium">{{ $stats['kamar_tersedia'] }}</span>
                </div>
                <div class="h-px bg-[#EDE8DC]">
                    <div class="h-px bg-[#B8935A]" style="width: {{ round($stats['kamar_tersedia']/$totalK*100) }}%"></div>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-[#8C7B65] tracking-wider">Terisi</span>
                    <span class="text-[#2A1D14] font-medium">{{ $stats['kamar_terisi'] }}</span>
                </div>
                <div class="h-px bg-[#EDE8DC]">
                    <div class="h-px bg-[#5C4033]" style="width: {{ round($stats['kamar_terisi']/$totalK*100) }}%"></div>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-[#8C7B65] tracking-wider">Perbaikan</span>
                    <span class="text-[#2A1D14] font-medium">{{ $stats['kamar_maintenance'] }}</span>
                </div>
                <div class="h-px bg-[#EDE8DC]">
                    <div class="h-px bg-[#A89880]" style="width: {{ round($stats['kamar_maintenance']/$totalK*100) }}%"></div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.rooms.index') }}"
            class="inline-flex items-center gap-2 text-xs text-[#B8935A] tracking-widest uppercase hover:text-[#9E7A42] transition-colors">
            Kelola kamar
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- Aksi Cepat --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Navigasi</p>
        <h3 class="text-xl font-light text-[#2A1D14] mb-5" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Akses Cepat</h3>

        <div class="space-y-2">
            @php
                $quickLinks = [
                    ['href' => route('admin.rooms.create'),            'label' => 'Tambah Kamar Baru'],
                    ['href' => route('admin.room-types.create'),       'label' => 'Tambah Tipe Kamar'],
                    ['href' => route('admin.facilities.create'),       'label' => 'Tambah Fasilitas'],
                    ['href' => route('admin.reservations.index') . '?status=pending', 'label' => 'Reservasi Pending', 'badge' => $stats['reservasi_pending']],
                ];
            @endphp

            @foreach($quickLinks as $link)
            <a href="{{ $link['href'] }}"
               class="flex items-center justify-between px-4 py-3 border border-[#EDE8DC] hover:border-[#B8935A] hover:bg-[#FDFCF8] transition-all duration-200 group">
                <span class="text-sm text-[#5C4033] group-hover:text-[#2A1D14] tracking-wide transition-colors">
                    {{ $link['label'] }}
                </span>
                <div class="flex items-center gap-2">
                    @if(isset($link['badge']) && $link['badge'] > 0)
                        <span class="w-5 h-5 flex items-center justify-center text-xs text-white" style="background-color: #B8935A;">
                            {{ $link['badge'] }}
                        </span>
                    @endif
                    <svg class="w-3.5 h-3.5 text-[#C9A96E]/50 group-hover:text-[#B8935A] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══════════════════ TABEL RESERVASI TERBARU ════ --}}
<div class="card-luxury overflow-hidden">
    <div class="px-6 py-5 border-b border-[#EDE8DC] flex items-end justify-between">
        <div>
            <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Data Terkini</p>
            <h3 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Reservasi Terbaru</h3>
        </div>
        <a href="{{ route('admin.reservations.index') }}"
            class="text-xs text-[#B8935A] tracking-widest uppercase hover:text-[#9E7A42] transition-colors flex items-center gap-1.5">
            Lihat semua
            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    @if($reservasiTerbaru->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-[#A89880]">
            <div class="w-10 h-px bg-[#DDD5C5] mb-6"></div>
            <p class="text-sm tracking-wider">Belum ada data reservasi</p>
            <div class="w-10 h-px bg-[#DDD5C5] mt-6"></div>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background-color: #FDFCF8;">
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-6 py-3 font-medium">Pelanggan</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Kamar</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Check-in</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Check-out</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Total</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservasiTerbaru as $i => $reservasi)
                    <tr class="border-t border-[#EDE8DC] hover:bg-[#FDFCF8] transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 flex items-center justify-center text-white text-xs font-medium shrink-0"
                                     style="background-color: #{{ ['B8935A','8C7B65','5C4033','3D2B1F'][$i % 4] }}">
                                    {{ strtoupper(substr($reservasi->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-[#2A1D14]">{{ $reservasi->user->name }}</p>
                                    <p class="text-xs text-[#A89880]">{{ $reservasi->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-sm font-medium text-[#2A1D14]">{{ $reservasi->room->room_number }}</p>
                            <p class="text-xs text-[#A89880]">{{ $reservasi->room->roomType->name }}</p>
                        </td>
                        <td class="px-4 py-4 text-sm text-[#5C4033]">
                            {{ $reservasi->check_in_date->format('d M Y') }}
                        </td>
                        <td class="px-4 py-4 text-sm text-[#5C4033]">
                            {{ $reservasi->check_out_date->format('d M Y') }}
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-sm font-medium text-[#2A1D14]">
                                Rp {{ number_format($reservasi->total_price, 0, ',', '.') }}
                            </p>
                        </td>
                        <td class="px-4 py-4">
                            @php
                                $badgeMap = [
                                    'pending'   => 'badge-pending',
                                    'confirmed' => 'badge-confirmed',
                                    'completed' => 'badge-completed',
                                    'cancelled' => 'badge-cancelled',
                                ];
                                $labelMap = [
                                    'pending'   => 'Pending',
                                    'confirmed' => 'Dikonfirmasi',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                            @endphp
                            <span class="badge {{ $badgeMap[$reservasi->status] ?? '' }}">
                                {{ $labelMap[$reservasi->status] ?? $reservasi->status }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-right">
                            <a href="{{ route('admin.reservations.show', $reservasi) }}"
                               class="text-xs text-[#B8935A] tracking-widest uppercase hover:text-[#9E7A42] transition-colors">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
