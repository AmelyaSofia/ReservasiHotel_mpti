@extends('layouts.admin')

@section('title', 'Detail Tipe Kamar')
@section('page_title', 'Tipe Kamar')
@section('breadcrumb', 'Master Data / Tipe Kamar / Detail')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('admin.room-types.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Tipe Kamar
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">{{ $roomType->name }}</span>
    </div>
    <div class="flex items-end justify-between">
        <div>
            <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
                {{ $roomType->name }}
            </h2>
            <div class="gold-line mt-3"></div>
        </div>
        <a href="{{ route('admin.room-types.edit', $roomType) }}" class="btn-primary py-2.5 px-6 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit
        </a>
    </div>
</div>

{{-- ════════════════════════ INFO CARDS ════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">

    {{-- Harga --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Harga Per Malam</p>
        <p class="text-3xl font-semibold text-[#2A1D14] mt-2">
            Rp {{ number_format($roomType->price_per_night, 0, ',', '.') }}
        </p>
        <div class="flex items-center gap-2 mt-2">
            <div class="w-6 h-px bg-[#B8935A]"></div>
            <p class="text-xs text-[#A89880]">Harga standar / malam</p>
        </div>
    </div>

    {{-- Jumlah Kamar --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Total Kamar</p>
        <p class="text-3xl font-semibold text-[#2A1D14] mt-2">
            {{ $roomType->rooms->count() }}
        </p>
        <div class="flex items-center gap-2 mt-2">
            <div class="w-6 h-px bg-[#B8935A]"></div>
            <p class="text-xs text-[#A89880]">Unit terdaftar</p>
        </div>
    </div>

    {{-- Harga Musiman Aktif --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Harga Musiman</p>
        @php $activeRate = $roomType->active_seasonal_rate; @endphp
        @if($activeRate)
            <p class="text-3xl font-semibold text-[#8C2323] mt-2">
                Rp {{ number_format($activeRate->price_per_night, 0, ',', '.') }}
            </p>
            <div class="flex items-center gap-2 mt-2">
                <div class="w-6 h-px bg-[#B8935A]"></div>
                <p class="text-xs text-[#A89880]">{{ $activeRate->description ?? 'Berlaku saat ini' }}</p>
            </div>
        @else
            <p class="text-xl font-light text-[#A89880] mt-2">—</p>
            <div class="flex items-center gap-2 mt-2">
                <div class="w-6 h-px bg-[#B8935A]"></div>
                <p class="text-xs text-[#A89880]">Tidak ada promo aktif</p>
            </div>
        @endif
    </div>
</div>

{{-- ════════════════════════ DESKRIPSI ════ --}}
<div class="card-luxury p-6 mb-8">
    <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Tentang Tipe Kamar</p>
    <h3 class="text-xl font-light text-[#2A1D14] mb-4" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Deskripsi</h3>
    <p class="text-sm text-[#5C4033] leading-relaxed">
        {{ $roomType->description ?? 'Tidak ada deskripsi untuk tipe kamar ini.' }}
    </p>
</div>

{{-- ════════════════════════ DAFTAR KAMAR ════ --}}
<div class="card-luxury overflow-hidden">
    <div class="px-6 py-5 border-b border-[#EDE8DC]">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Kamar Terdaftar</p>
        <h3 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
            Daftar Kamar {{ $roomType->name }}
        </h3>
    </div>

    @if($roomType->rooms->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-[#A89880]">
            <div class="w-10 h-px bg-[#DDD5C5] mb-6"></div>
            <p class="text-sm tracking-wider">Belum ada kamar untuk tipe ini</p>
            <a href="{{ route('admin.rooms.create') }}" class="mt-4 text-xs text-[#B8935A] tracking-widest uppercase hover:underline">
                Tambah kamar baru
            </a>
            <div class="w-10 h-px bg-[#DDD5C5] mt-6"></div>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background-color: #FDFCF8;">
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-6 py-4 font-medium">No. Kamar</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Kapasitas</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EDE8DC]">
                    @foreach($roomType->rooms as $room)
                        <tr class="hover:bg-[#FDFCF8] transition-colors">
                            <td class="px-6 py-4 font-medium text-[#2A1D14]">{{ $room->room_number }}</td>
                            <td class="px-4 py-4 text-[#8C7B65]">{{ $room->capacity }} Orang</td>
                            <td class="px-4 py-4">
                                @php
                                    $statusBadge = [
                                        'available'   => 'badge-available',
                                        'occupied'    => 'badge-occupied',
                                        'maintenance' => 'badge-maintenance',
                                    ];
                                    $statusLabel = [
                                        'available'   => 'Tersedia',
                                        'occupied'    => 'Terisi',
                                        'maintenance' => 'Perbaikan',
                                    ];
                                @endphp
                                <span class="badge {{ $statusBadge[$room->status] ?? '' }}">
                                    {{ $statusLabel[$room->status] ?? $room->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.rooms.show', $room) }}" class="text-xs text-[#B8935A] hover:text-[#9E7A42] font-semibold tracking-wider uppercase transition-colors">
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

{{-- ════════════════════════ BACK BUTTON ════ --}}
<div class="mt-8">
    <a href="{{ route('admin.room-types.index') }}" class="inline-flex items-center gap-2 text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Tipe Kamar
    </a>
</div>

@endsection