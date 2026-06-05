@extends('layouts.admin')

@section('title', 'Manajemen Kamar')
@section('page_title', 'Kelola Kamar')
@section('breadcrumb', 'Daftar kamar hotel yang terdaftar dalam sistem')

@section('content')

{{-- ════════════════════════ PAGE HEADER & ACTIONS ════ --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <p class="text-xs text-[#B8935A] tracking-[0.3em] uppercase mb-2">Master Data</p>
        <h2 class="text-3xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">
            Kamar Hotel
        </h2>
        <div class="gold-line mt-3"></div>
    </div>
    <div>
        <a href="{{ route('admin.rooms.create') }}" class="btn-primary flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kamar Baru
        </a>
    </div>
</div>

{{-- ════════════════════════ ROOMS LIST ════ --}}
<div class="card-luxury overflow-hidden">
    <div class="px-6 py-5 border-b border-[#EDE8DC]">
        <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Daftar Kamar</p>
        <h3 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">Semua Unit Kamar</h3>
    </div>

    @if($rooms->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-[#A89880]">
            <div class="w-10 h-px bg-[#DDD5C5] mb-6"></div>
            <p class="text-sm tracking-wider">Belum ada data kamar terdaftar</p>
            <a href="{{ route('admin.rooms.create') }}" class="mt-4 text-xs text-[#B8935A] tracking-widest uppercase hover:underline">
                Mulai tambah kamar
            </a>
            <div class="w-10 h-px bg-[#DDD5C5] mt-6"></div>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background-color: #FDFCF8;">
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-6 py-4 font-medium">Nomor Kamar</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Tipe Kamar</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Kapasitas</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Harga per Malam</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Fasilitas</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr class="border-t border-[#EDE8DC] hover:bg-[#FDFCF8] transition-colors">
                        {{-- Nomor Kamar --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-[#EDE8DC] shrink-0 overflow-hidden flex items-center justify-center border border-[#DDD5C5]">
                                    @if($room->image)
                                        <img src="{{ asset('storage/' . $room->image) }}" alt="Kamar {{ $room->room_number }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-5 h-5 text-[#8C7B65]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1.091m-18.75 0l3-1.091m0 0V9m0 0L9 5.454m9 1.636V9m-9-3.545L20.25 9m-11-3.545V21"/>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-[#2A1D14]">Kamar {{ $room->room_number }}</p>
                                    <p class="text-xs text-[#A89880]">ID: #{{ $room->id }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Tipe Kamar --}}
                        <td class="px-4 py-5">
                            <p class="text-sm font-medium text-[#2A1D14]">{{ $room->roomType->name }}</p>
                        </td>

                        {{-- Kapasitas --}}
                        <td class="px-4 py-5 text-sm text-[#5C4033]">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-[#8C7B65]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                                <span>{{ $room->capacity }} Orang</span>
                            </div>
                        </td>

                        {{-- Harga --}}
                        <td class="px-4 py-5">
                            <p class="text-sm font-semibold text-[#2A1D14]">
                                Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}
                            </p>
                            <p class="text-[10px] text-[#A89880] tracking-wider uppercase">Per Malam</p>
                        </td>

                        {{-- Fasilitas --}}
                        <td class="px-4 py-5 max-w-xs">
                            <div class="flex flex-wrap gap-1">
                                @forelse($room->facilities as $fac)
                                    <span class="text-[10px] bg-white border border-[#EDE8DC] text-[#705F4A] px-2 py-0.5 tracking-wide rounded-none">
                                        {{ $fac->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-[#A89880] italic">Tidak ada fasilitas khusus</span>
                                @endforelse
                            </div>
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-5">
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
                            <span class="badge {{ $badgeClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-3.5">
                                <a href="{{ route('admin.rooms.show', $room) }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] font-medium tracking-wider uppercase transition-colors" title="Detail Kamar">
                                    Detail
                                </a>
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="text-xs text-[#B8935A] hover:text-[#9E7A42] font-medium tracking-wider uppercase transition-colors" title="Ubah Kamar">
                                    Edit
                                </a>
                                <button type="button" onclick="openLuxuryModal('{{ route('admin.rooms.destroy', $room) }}', 'DELETE', 'Hapus Kamar', 'Apakah Anda yakin ingin menghapus Kamar {{ $room->room_number }}? Kamar yang terhapus tidak dapat dipulihkan.', 'Hapus')" class="text-xs text-red-700 hover:text-red-900 font-medium tracking-wider uppercase transition-colors" title="Hapus Kamar">
                                        Hapus
                                    </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($rooms->hasPages())
            <div class="px-6 py-5 border-t border-[#EDE8DC] bg-[#FDFCF8] flex items-center justify-between">
                <div class="text-xs text-[#8C7B65]">
                    Menampilkan {{ $rooms->firstItem() }} hingga {{ $rooms->lastItem() }} dari {{ $rooms->total() }} unit kamar
                </div>
                <div>
                    {{ $rooms->links() }}
                </div>
            </div>
        @endif
    @endif
</div>

@endsection
