@extends('layouts.admin')

@section('title', 'Fasilitas')
@section('page_title', 'Fasilitas')
@section('breadcrumb', 'Master Data / Fasilitas')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <p class="text-xs text-[#B8935A] tracking-[0.3em] uppercase mb-2">Master Data</p>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Kelola Fasilitas
    </h2>
    <div class="gold-line mt-3"></div>
</div>

{{-- ════════════════════════ FACILITIES TABLE ════ --}}
<div class="card-luxury overflow-hidden">
    <div class="px-6 py-5 border-b border-[#EDE8DC] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Daftar Fasilitas</p>
            <h3 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Semua Fasilitas</h3>
        </div>
        <div>
            <a href="{{ route('admin.facilities.create') }}" class="btn-primary flex items-center gap-2 py-2.5 px-6">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Fasilitas
            </a>
        </div>
    </div>

    @if($facilities->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-[#A89880]">
            <div class="w-10 h-px bg-[#DDD5C5] mb-6"></div>
            <p class="text-sm tracking-wider">Belum ada data fasilitas terdaftar</p>
            <a href="{{ route('admin.facilities.create') }}" class="mt-4 text-xs text-[#B8935A] tracking-widest uppercase hover:underline">
                Mulai tambah fasilitas
            </a>
            <div class="w-10 h-px bg-[#DDD5C5] mt-6"></div>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background-color: #FDFCF8;">
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-6 py-4 font-medium">Nama Fasilitas</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EDE8DC]">
                    @foreach($facilities as $f)
                        <tr class="hover:bg-[#FDFCF8] transition-colors">
                            <td class="px-6 py-4 font-medium text-[#2A1D14]">{{ $f->name }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-4">
                                    <a href="{{ route('admin.facilities.edit', $f) }}" class="text-xs text-[#B8935A] hover:text-[#9E7A42] font-semibold tracking-wider uppercase transition-colors">
                                        Edit
                                    </a>
                                    <button type="button" 
                                            onclick="openLuxuryModal('{{ route('admin.facilities.destroy', $f) }}', 'DELETE', 'Hapus Fasilitas', 'Apakah Anda yakin ingin menghapus fasilitas {{ $f->name }}?', 'Hapus')" 
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
        @if($facilities->hasPages())
            <div class="px-6 py-5 border-t border-[#EDE8DC] bg-[#FDFCF8] flex items-center justify-between">
                <div class="text-xs text-[#8C7B65]">
                    Menampilkan {{ $facilities->firstItem() }} hingga {{ $facilities->lastItem() }} dari {{ $facilities->total() }} fasilitas
                </div>
                <div>
                    {{ $facilities->links() }}
                </div>
            </div>
        @endif
    @endif
</div>
@endsection