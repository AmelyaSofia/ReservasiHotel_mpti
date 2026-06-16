@extends('layouts.admin')

@section('title', 'Detail Reservasi')
@section('page_title', 'Reservasi')
@section('breadcrumb', 'Transaksi / Reservasi / Detail')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('admin.reservations.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Reservasi
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Detail #{{ $reservation->id }}</span>
    </div>
    <div class="flex items-end justify-between">
        <div>
            <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
                Reservasi #{{ $reservation->id }}
            </h2>
            <div class="gold-line mt-3"></div>
        </div>
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
        <span class="badge {{ $badgeMap[$reservation->status] ?? '' }}">
            {{ $labelMap[$reservation->status] ?? $reservation->status }}
        </span>
    </div>
</div>

{{-- ════════════════════════ INFO CARDS ════ --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">

    {{-- Pelanggan --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4">Informasi Pelanggan</p>
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 flex items-center justify-center text-white text-sm font-semibold shrink-0"
                 style="background-color: #B8935A;">
                {{ strtoupper(substr($reservation->user->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-medium text-[#2A1D14]">{{ $reservation->user->name }}</p>
                <p class="text-xs text-[#A89880]">{{ $reservation->user->email }}</p>
            </div>
        </div>
    </div>

    {{-- Kamar --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4">Informasi Kamar</p>
        <p class="text-2xl font-semibold text-[#2A1D14] mb-1">{{ $reservation->room->room_number }}</p>
        <p class="text-sm text-[#8C7B65]">{{ $reservation->room->roomType->name ?? '-' }}</p>
        @if($reservation->room->facilities->count() > 0)
            <div class="flex flex-wrap gap-1 mt-3">
                @foreach($reservation->room->facilities->take(3) as $fac)
                    <span class="text-[9px] bg-[#F7F4EE] text-[#705F4A] px-2 py-0.5 tracking-wide border border-transparent">
                        {{ $fac->name }}
                    </span>
                @endforeach
                @if($reservation->room->facilities->count() > 3)
                    <span class="text-[9px] text-[#A89880] px-1 py-0.5 font-semibold">
                        +{{ $reservation->room->facilities->count() - 3 }}
                    </span>
                @endif
            </div>
        @endif
    </div>

    {{-- Total Harga --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4">Total Pembayaran</p>
        <p class="text-3xl font-semibold text-[#2A1D14]">
            Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
        </p>
        <div class="flex items-center gap-2 mt-2">
            <div class="w-6 h-px bg-[#B8935A]"></div>
            <p class="text-xs text-[#A89880]">{{ $reservation->nights }} malam</p>
        </div>
    </div>
</div>

{{-- ════════════════════════ DETAIL JADWAL & PEMBAYARAN ════ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-8">

    {{-- Jadwal --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4">Jadwal Menginap</p>
        <div class="space-y-4">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs text-[#8C7B65] tracking-wider uppercase">Check-In</p>
                    <p class="text-sm font-medium text-[#2A1D14] mt-1">{{ $reservation->check_in_date->format('d F Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-[#8C7B65] tracking-wider uppercase">Check-Out</p>
                    <p class="text-sm font-medium text-[#2A1D14] mt-1">{{ $reservation->check_out_date->format('d F Y') }}</p>
                </div>
            </div>
            <div class="h-px bg-[#EDE8DC]"></div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-[#8C7B65] tracking-wider uppercase">Durasi</p>
                <p class="text-sm font-medium text-[#2A1D14]">{{ $reservation->nights }} Malam</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-[#8C7B65] tracking-wider uppercase">Dibuat Pada</p>
                <p class="text-sm text-[#8C7B65]">{{ $reservation->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </div>

    {{-- Status Pembayaran --}}
    <div class="card-luxury p-6">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4">Status Pembayaran</p>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <p class="text-xs text-[#8C7B65] tracking-wider uppercase">Status Reservasi</p>
                <span class="badge {{ $badgeMap[$reservation->status] ?? '' }}">
                    {{ $labelMap[$reservation->status] ?? $reservation->status }}
                </span>
            </div>
            <div class="h-px bg-[#EDE8DC]"></div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-[#8C7B65] tracking-wider uppercase">Status Bayar</p>
                @php
                    $paymentLabels = [
                        'unpaid'    => ['label' => 'Belum Dibayar', 'class' => 'badge-pending'],
                        'pending'   => ['label' => 'Menunggu',      'class' => 'badge-pending'],
                        'paid'      => ['label' => 'Lunas',         'class' => 'badge-completed'],
                        'failed'    => ['label' => 'Gagal',         'class' => 'badge-cancelled'],
                        'expired'   => ['label' => 'Kadaluarsa',    'class' => 'badge-cancelled'],
                        'challenge' => ['label' => 'Challenge',     'class' => 'badge-pending'],
                    ];
                    $ps = $paymentLabels[$reservation->payment_status] ?? ['label' => $reservation->payment_status ?? '-', 'class' => ''];
                @endphp
                <span class="badge {{ $ps['class'] }}">{{ $ps['label'] }}</span>
            </div>
            @if($reservation->snap_token)
            <div class="h-px bg-[#EDE8DC]"></div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-[#8C7B65] tracking-wider uppercase">Snap Token</p>
                <p class="text-xs text-[#8C7B65] font-mono">{{ Str::limit($reservation->snap_token, 20) }}</p>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- ════════════════════════ AKSI ════ --}}
<div class="card-luxury p-6">
    <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-4">Tindakan</p>
    <div class="flex flex-wrap gap-3">
        @if($reservation->status == 'pending')
            <button type="button"
                onclick="openLuxuryModal('{{ route('admin.reservations.confirm', $reservation) }}', 'PATCH', 'Konfirmasi Reservasi', 'Apakah Anda yakin ingin mengkonfirmasi reservasi #{{ $reservation->id }}? Pelanggan akan mendapat status dikonfirmasi.', 'Konfirmasi', 'bg-[#5C4033] hover:bg-[#3D2B1F]')"
                class="btn-primary py-2.5 px-6">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Konfirmasi Reservasi
            </button>
        @endif

        @if($reservation->status == 'confirmed')
            <button type="button"
                onclick="openLuxuryModal('{{ route('admin.reservations.complete', $reservation) }}', 'PATCH', 'Selesaikan Reservasi', 'Apakah Anda yakin ingin menandai reservasi #{{ $reservation->id }} sebagai selesai? Kamar akan kembali tersedia.', 'Tandai Selesai', 'bg-[#5C4033] hover:bg-[#3D2B1F]')"
                class="btn-primary py-2.5 px-6">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Tandai Selesai
            </button>
        @endif

        @if(in_array($reservation->status, ['pending', 'confirmed']))
            <button type="button"
                onclick="openLuxuryModal('{{ route('admin.reservations.cancel', $reservation) }}', 'PATCH', 'Batalkan Reservasi', 'Apakah Anda yakin ingin membatalkan reservasi #{{ $reservation->id }}? Kamar akan kembali tersedia.', 'Batalkan Reservasi')"
                class="btn-danger py-2.5 px-6">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Batalkan Reservasi
            </button>
        @endif

        <a href="{{ route('admin.reservations.index') }}" class="btn-outline py-2.5 px-6 ml-auto">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>
</div>

@endsection