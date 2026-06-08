@extends('layouts.admin')

@section('title', 'Kelola Reservasi')
@section('page_title', 'Kelola Reservasi')
@section('breadcrumb', 'Transaksi / Reservasi')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <p class="text-xs text-[#B8935A] tracking-[0.3em] uppercase mb-2">Transaksi</p>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Daftar Reservasi
    </h2>
    <div class="gold-line mt-3"></div>
</div>

{{-- ════════════════════════ RESERVATIONS TABLE ════ --}}
<div class="card-luxury overflow-hidden">
    <div class="px-6 py-5 border-b border-[#EDE8DC] flex items-center justify-between">
        <div>
            <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Data Transaksi</p>
            <h3 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Semua Reservasi</h3>
        </div>
    </div>

    @if($reservations->isEmpty())
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
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-6 py-4 font-medium">ID</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Pelanggan</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Kamar</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Check In/Out</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Total Harga</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EDE8DC]">
                    @foreach($reservations as $r)
                        <tr class="hover:bg-[#FDFCF8] transition-colors">
                            <td class="px-6 py-4 font-medium text-[#2A1D14]">#{{ $r->id }}</td>
                            <td class="px-4 py-4 font-medium text-[#2A1D14]">{{ $r->user->name ?? '-' }}</td>
                            <td class="px-4 py-4 text-[#2A1D14]">{{ $r->room->room_number ?? '-' }}</td>
                            <td class="px-4 py-4 text-[#8C7B65] whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($r->check_in_date)->format('d M y') }} - {{ \Carbon\Carbon::parse($r->check_out_date)->format('d M y') }}
                            </td>
                            <td class="px-4 py-4 text-[#8C7B65]">Rp {{ number_format($r->total_price, 0, ',', '.') }}</td>
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
                                <span class="badge {{ $badgeMap[$r->status] ?? '' }}">
                                    {{ $labelMap[$r->status] ?? $r->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.reservations.show', $r) }}" class="text-xs text-[#B8935A] hover:text-[#9E7A42] font-semibold tracking-wider uppercase transition-colors">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($reservations->hasPages())
            <div class="px-6 py-5 border-t border-[#EDE8DC] bg-[#FDFCF8] flex items-center justify-between">
                <div class="text-xs text-[#8C7B65]">
                    Menampilkan {{ $reservations->firstItem() }} hingga {{ $reservations->lastItem() }} dari {{ $reservations->total() }} reservasi
                </div>
                <div>
                    {{ $reservations->links() }}
                </div>
            </div>
        @endif
    @endif
</div>
@endsection