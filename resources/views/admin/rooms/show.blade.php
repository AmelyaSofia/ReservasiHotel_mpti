@extends('layouts.admin')

@section('title', 'Detail Kamar ' . $room->room_number)
@section('page_title', 'Kelola Kamar')
@section('breadcrumb', 'Rincian detail unit kamar dan riwayat hunian')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('admin.rooms.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Kamar
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Detail Kamar</span>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">
                Kamar {{ $room->room_number }}
            </h2>
            <div class="gold-line mt-3"></div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.rooms.edit', $room) }}" class="btn-primary flex items-center gap-2 py-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                Ubah Kamar
            </a>
            <a href="{{ route('admin.rooms.index') }}" class="btn-outline flex items-center gap-2 py-2">
                Kembali
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    
    {{-- LEFT SECTION: IMAGE & DETAIL SPECS (2/3 width) --}}
    <div class="lg:col-span-2 space-y-6">
        
        {{-- Room Image & Info Card --}}
        <div class="card-luxury overflow-hidden">
            {{-- Big Image --}}
            <div class="relative w-full aspect-video bg-[#EDE8DC] border-b border-[#EDE8DC]">
                @if($room->image)
                    <img src="{{ asset('storage/' . $room->image) }}" alt="Kamar {{ $room->room_number }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-[#8C7B65] p-6 text-center">
                        <svg class="w-16 h-16 opacity-30 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1.091m-18.75 0l3-1.091m0 0V9m0 0L9 5.454m9 1.636V9m-9-3.545L20.25 9m-11-3.545V21"/>
                        </svg>
                        <p class="text-sm tracking-wider uppercase font-semibold text-[#A89880]">Belum Ada Foto</p>
                    </div>
                @endif

                {{-- Status Badge absolute --}}
                <div class="absolute top-4 right-4">
                    @php
                        $badgeClass = 'badge-available';
                        $statusLabel = 'Tersedia';
                        if ($room->status === 'occupied') {
                            $badgeClass = 'badge-occupied';
                            $statusLabel = 'Terisi';
                        } elseif ($room->status === 'maintenance') {
                            $badgeClass = 'badge-maintenance';
                            $statusLabel = 'Perbaikan';
                        }
                    @endphp
                    <span class="badge {{ $badgeClass }} shadow-md px-4 py-1 text-sm bg-white">
                        {{ $statusLabel }}
                    </span>
                </div>
            </div>

            {{-- Descriptive details --}}
            <div class="p-6 sm:p-8 space-y-6">
                <div>
                    <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1 font-semibold">Deskripsi</p>
                    <h3 class="text-xl font-light text-[#2A1D14] mb-3" style="font-family: 'Cormorant Garamond', serif;">Pengantar Kamar</h3>
                    <p class="text-sm text-[#5C4033] leading-relaxed whitespace-pre-line">{{ $room->description }}</p>
                </div>

                <div>
                    <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-3 font-semibold">Fasilitas yang Tersedia</p>
                    <div class="flex flex-wrap gap-2">
                        @forelse($room->facilities as $fac)
                            <div class="flex items-center gap-1.5 px-3 py-1.5 border border-[#EDE8DC] bg-[#FDFCF8] text-[#5C4033] text-xs font-medium tracking-wide">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#B8935A]"></span>
                                <span>{{ $fac->name }}</span>
                            </div>
                        @empty
                            <p class="text-xs text-[#A89880] italic">Tidak ada fasilitas khusus yang terpasang.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- RIGHT SECTION: METRICS & SPECIFICATIONS --}}
    <div class="space-y-6">
        
        {{-- Room Specs Card --}}
        <div class="card-luxury p-6 space-y-5">
            <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 font-semibold">
                Spesifikasi Teknis
            </p>

            <div class="space-y-4">
                <div class="flex justify-between border-b border-[#F7F4EE] pb-2">
                    <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Tipe Kamar</span>
                    <span class="text-sm font-semibold text-[#2A1D14]">{{ $room->roomType->name }}</span>
                </div>
                <div class="flex justify-between border-b border-[#F7F4EE] pb-2">
                    <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Nomor Kamar</span>
                    <span class="text-sm font-semibold text-[#2A1D14]">{{ $room->room_number }}</span>
                </div>
                <div class="flex justify-between border-b border-[#F7F4EE] pb-2">
                    <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Kapasitas Maksimal</span>
                    <span class="text-sm font-semibold text-[#2A1D14]">{{ $room->capacity }} Orang</span>
                </div>
                <div class="flex justify-between pb-1">
                    <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Harga per Malam</span>
                    <span class="text-sm font-bold text-[#B8935A]">Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Occupancy Stats --}}
        <div class="card-luxury p-6 space-y-5">
            <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 font-semibold">
                Statistik Hunian Kamar
            </p>

            @php
                $activeReservations = $room->reservations->whereIn('status', ['pending', 'confirmed'])->count();
                $completedReservations = $room->reservations->where('status', 'completed')->count();
                $totalRevenue = $room->reservations->whereIn('status', ['confirmed', 'completed'])->sum('total_price');
            @endphp

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-[#F7F4EE] p-3 text-center border border-[#EDE8DC]">
                    <p class="text-2xl font-light text-[#2A1D14] font-serif">{{ $activeReservations }}</p>
                    <p class="text-[9px] text-[#A89880] tracking-wider uppercase mt-1">Aktif/Pending</p>
                </div>
                <div class="bg-[#F7F4EE] p-3 text-center border border-[#EDE8DC]">
                    <p class="text-2xl font-light text-[#2A1D14] font-serif">{{ $completedReservations }}</p>
                    <p class="text-[9px] text-[#A89880] tracking-wider uppercase mt-1">Selesai</p>
                </div>
                <div class="col-span-2 bg-[#F7F4EE] p-3 text-center border border-[#EDE8DC]">
                    <p class="text-xl font-semibold text-[#B8935A] font-serif">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <p class="text-[9px] text-[#A89880] tracking-wider uppercase mt-1">Estimasi Pendapatan Kamar</p>
                </div>
            </div>
        </div>
        
    </div>
</div>

{{-- ════════════════════════ RESERVATION HISTORY ════ --}}
<div class="card-luxury overflow-hidden">
    <div class="px-6 py-5 border-b border-[#EDE8DC]">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Riwayat Reservasi</p>
        <h3 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">Daftar Hunian Tamu</h3>
    </div>

    @if($room->reservations->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-[#A89880]">
            <div class="w-8 h-px bg-[#DDD5C5] mb-4"></div>
            <p class="text-sm tracking-wider">Belum ada riwayat reservasi untuk kamar ini</p>
            <div class="w-8 h-px bg-[#DDD5C5] mt-4"></div>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background-color: #FDFCF8;">
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-6 py-3 font-medium">Tamu</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Tanggal Check-in</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Tanggal Check-out</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Jumlah Malam</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Total Harga</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-3 font-medium">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($room->reservations->sortByDesc('created_at') as $reservasi)
                    <tr class="border-t border-[#EDE8DC] hover:bg-[#FDFCF8] transition-colors">
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-semibold text-[#2A1D14]">{{ $reservasi->user->name }}</p>
                                <p class="text-xs text-[#A89880]">{{ $reservasi->user->email }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-sm text-[#5C4033]">
                            {{ $reservasi->check_in_date->format('d M Y') }}
                        </td>
                        <td class="px-4 py-4 text-sm text-[#5C4033]">
                            {{ $reservasi->check_out_date->format('d M Y') }}
                        </td>
                        <td class="px-4 py-4 text-sm text-[#5C4033]">
                            {{ $reservasi->nights }} Malam
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-sm font-semibold text-[#2A1D14]">
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
                        <td class="px-6 py-4 text-right">
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
