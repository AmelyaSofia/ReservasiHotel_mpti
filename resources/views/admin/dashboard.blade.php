@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('breadcrumb', 'Selamat datang kembali, ' . auth()->user()->name)

@section('content')

{{-- ════════════════════════════════════ STAT CARDS ════ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

    {{-- Total Kamar --}}
    <div class="card p-5 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-400 uppercase tracking-wide">Total Kamar</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['total_kamar'] }}</p>
        </div>
    </div>

    {{-- Kamar Tersedia --}}
    <div class="card p-5 flex items-center gap-4">
        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-400 uppercase tracking-wide">Tersedia</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['kamar_tersedia'] }}</p>
        </div>
    </div>

    {{-- Kamar Terisi --}}
    <div class="card p-5 flex items-center gap-4">
        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-400 uppercase tracking-wide">Terisi</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['kamar_terisi'] }}</p>
        </div>
    </div>

    {{-- Total Pelanggan --}}
    <div class="card p-5 flex items-center gap-4">
        <div class="w-12 h-12 bg-violet-50 rounded-2xl flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-medium text-slate-400 uppercase tracking-wide">Pelanggan</p>
            <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $stats['total_pelanggan'] }}</p>
        </div>
    </div>
</div>

{{-- ══════════════════════════════ STATUS RESERVASI + KAMAR ════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">

    {{-- Ringkasan Reservasi --}}
    <div class="card p-5 col-span-1">
        <h2 class="text-sm font-semibold text-slate-700 mb-4">Status Reservasi</h2>

        <div class="space-y-3">
            {{-- Pending --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    <span class="text-sm text-slate-600">Pending</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-28 h-2 bg-slate-100 rounded-full overflow-hidden">
                        @php
                            $total = max($stats['total_reservasi'], 1);
                            $pct = round($stats['reservasi_pending'] / $total * 100);
                        @endphp
                        <div class="h-full bg-amber-400 rounded-full" style="width: {{ $pct }}%"></div>
                    </div>
                    <span class="text-sm font-semibold text-slate-700 w-6 text-right">{{ $stats['reservasi_pending'] }}</span>
                </div>
            </div>

            {{-- Confirmed --}}
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    <span class="text-sm text-slate-600">Dikonfirmasi</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-28 h-2 bg-slate-100 rounded-full overflow-hidden">
                        @php $pct = round($stats['reservasi_confirmed'] / $total * 100); @endphp
                        <div class="h-full bg-blue-500 rounded-full" style="width: {{ $pct }}%"></div>
                    </div>
                    <span class="text-sm font-semibold text-slate-700 w-6 text-right">{{ $stats['reservasi_confirmed'] }}</span>
                </div>
            </div>

            {{-- Total --}}
            <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-sm text-slate-500">Total Reservasi</span>
                <span class="text-lg font-bold text-slate-800">{{ $stats['total_reservasi'] }}</span>
            </div>
        </div>

        <a href="{{ route('admin.reservations.index') }}"
            class="mt-4 flex items-center gap-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 transition-colors">
            Lihat semua reservasi
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- Status Kamar --}}
    <div class="card p-5 col-span-1">
        <h2 class="text-sm font-semibold text-slate-700 mb-4">Status Kamar</h2>

        <div class="space-y-4">
            @php
                $totalKamar = max($stats['total_kamar'], 1);
                $pctAvail = round($stats['kamar_tersedia'] / $totalKamar * 100);
                $pctOccup = round($stats['kamar_terisi'] / $totalKamar * 100);
                $pctMaint = round($stats['kamar_maintenance'] / $totalKamar * 100);
            @endphp

            <div>
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-emerald-600 font-medium">Tersedia</span>
                    <span class="text-slate-600">{{ $stats['kamar_tersedia'] }} ({{ $pctAvail }}%)</span>
                </div>
                <div class="h-2.5 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full transition-all duration-500" style="width: {{ $pctAvail }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-blue-600 font-medium">Terisi</span>
                    <span class="text-slate-600">{{ $stats['kamar_terisi'] }} ({{ $pctOccup }}%)</span>
                </div>
                <div class="h-2.5 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full transition-all duration-500" style="width: {{ $pctOccup }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-xs mb-1">
                    <span class="text-orange-600 font-medium">Perbaikan</span>
                    <span class="text-slate-600">{{ $stats['kamar_maintenance'] }} ({{ $pctMaint }}%)</span>
                </div>
                <div class="h-2.5 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-orange-500 rounded-full transition-all duration-500" style="width: {{ $pctMaint }}%"></div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.rooms.index') }}"
            class="mt-4 flex items-center gap-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 transition-colors">
            Kelola kamar
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- Akses Cepat --}}
    <div class="card p-5 col-span-1">
        <h2 class="text-sm font-semibold text-slate-700 mb-4">Akses Cepat</h2>
        <div class="space-y-2.5">
            <a href="{{ route('admin.rooms.create') }}"
                class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50 transition-all group">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700">Tambah Kamar Baru</span>
            </a>

            <a href="{{ route('admin.room-types.create') }}"
                class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 hover:border-violet-200 hover:bg-violet-50 transition-all group">
                <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center group-hover:bg-violet-200 transition-colors">
                    <svg class="w-4 h-4 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-slate-700">Tambah Tipe Kamar</span>
            </a>

            <a href="{{ route('admin.reservations.index') }}?status=pending"
                class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 hover:border-amber-200 hover:bg-amber-50 transition-all group">
                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center group-hover:bg-amber-200 transition-colors">
                    <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <div class="flex-1 flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-700">Reservasi Pending</span>
                    @if($stats['reservasi_pending'] > 0)
                        <span class="text-xs font-bold bg-amber-500 text-white rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $stats['reservasi_pending'] }}
                        </span>
                    @endif
                </div>
            </a>
        </div>
    </div>
</div>

{{-- ═══════════════════════════ TABEL RESERVASI TERBARU ════ --}}
<div class="card overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
        <h2 class="font-semibold text-slate-800">Reservasi Terbaru</h2>
        <a href="{{ route('admin.reservations.index') }}"
            class="text-xs font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
            Lihat semua
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    @if($reservasiTerbaru->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-slate-400">
            <svg class="w-12 h-12 mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-sm">Belum ada reservasi</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-6 py-3">Pelanggan</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-4 py-3">Kamar</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-4 py-3">Check-in</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-4 py-3">Check-out</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-4 py-3">Total</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-4 py-3">Status</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($reservasiTerbaru as $reservasi)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-6 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0">
                                    {{ strtoupper(substr($reservasi->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-800">{{ $reservasi->user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $reservasi->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            <p class="font-medium text-slate-800">{{ $reservasi->room->room_number }}</p>
                            <p class="text-xs text-slate-400">{{ $reservasi->room->roomType->name }}</p>
                        </td>
                        <td class="px-4 py-3.5 text-slate-600">
                            {{ $reservasi->check_in_date->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3.5 text-slate-600">
                            {{ $reservasi->check_out_date->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3.5 font-semibold text-slate-800">
                            Rp {{ number_format($reservasi->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3.5">
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
                        </td>
                        <td class="px-4 py-3.5 text-right">
                            <a href="{{ route('admin.reservations.show', $reservasi) }}"
                                class="text-xs font-medium text-blue-600 hover:text-blue-700 transition-colors">
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
