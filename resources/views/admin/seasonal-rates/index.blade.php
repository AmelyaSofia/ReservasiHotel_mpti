@extends('layouts.admin')

@section('title', 'Harga Dinamis')
@section('page_title', 'Harga Dinamis')
@section('breadcrumb', 'Master Data / Harga Dinamis')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <p class="text-xs text-[#B8935A] tracking-[0.3em] uppercase mb-2">Master Data</p>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Kelola Harga Dinamis
    </h2>
    <div class="gold-line mt-3"></div>
</div>

{{-- ════════════════════════ TABLE ════ --}}
<div class="card-luxury overflow-hidden">
    <div class="px-6 py-5 border-b border-[#EDE8DC] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Harga Musiman</p>
            <h3 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Semua Harga Dinamis</h3>
        </div>
        <div>
            <a href="{{ route('admin.seasonal-rates.create') }}" class="btn-primary flex items-center gap-2 py-2.5 px-6">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Harga Baru
            </a>
        </div>
    </div>

    @if($rates->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-[#A89880]">
            <div class="w-10 h-px bg-[#DDD5C5] mb-6"></div>
            <p class="text-sm tracking-wider">Belum ada data harga dinamis</p>
            <a href="{{ route('admin.seasonal-rates.create') }}" class="mt-4 text-xs text-[#B8935A] tracking-widest uppercase hover:underline">
                Mulai tambah harga baru
            </a>
            <div class="w-10 h-px bg-[#DDD5C5] mt-6"></div>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background-color: #FDFCF8;">
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-6 py-4 font-medium">Tipe Kamar</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Mulai Tanggal</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Sampai Tanggal</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Harga / Malam</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Keterangan</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EDE8DC]">
                    @foreach($rates as $rate)
                        @php
                            $isActive = $rate->start_date->lte(now()) && $rate->end_date->gte(now());
                        @endphp
                        <tr class="hover:bg-[#FDFCF8] transition-colors">
                            <td class="px-6 py-4 font-medium text-[#2A1D14]">{{ $rate->roomType->name }}</td>
                            <td class="px-4 py-4 text-[#8C7B65]">{{ $rate->start_date->format('d M Y') }}</td>
                            <td class="px-4 py-4 text-[#8C7B65]">{{ $rate->end_date->format('d M Y') }}</td>
                            <td class="px-4 py-4 font-medium text-[#2A1D14]">Rp {{ number_format($rate->price_per_night, 0, ',', '.') }}</td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-[#8C7B65]">{{ $rate->description ?? '—' }}</span>
                                    @if($isActive)
                                        <span class="text-[8px] bg-[#B8935A] text-white px-1.5 py-0.5 tracking-wider uppercase font-semibold">Aktif</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('admin.seasonal-rates.edit', $rate) }}" class="text-xs text-[#B8935A] hover:text-[#9E7A42] font-semibold tracking-wider uppercase transition-colors">
                                        Edit
                                    </a>
                                    <button type="button"
                                            onclick="openLuxuryModal('{{ route('admin.seasonal-rates.destroy', $rate) }}', 'DELETE', 'Hapus Harga Dinamis', 'Apakah Anda yakin ingin menghapus harga dinamis untuk {{ $rate->roomType->name }} ({{ $rate->start_date->format('d M Y') }} — {{ $rate->end_date->format('d M Y') }})?', 'Hapus')"
                                            class="text-xs text-red-700 hover:text-red-900 font-semibold tracking-wider uppercase transition-colors">
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
        @if($rates->hasPages())
            <div class="px-6 py-5 border-t border-[#EDE8DC] bg-[#FDFCF8] flex items-center justify-between">
                <div class="text-xs text-[#8C7B65]">
                    Menampilkan {{ $rates->firstItem() }} hingga {{ $rates->lastItem() }} dari {{ $rates->total() }} harga
                </div>
                <div>
                    {{ $rates->links() }}
                </div>
            </div>
        @endif
    @endif
</div>
@endsection
