@extends('layouts.admin')

@section('title', 'Kelola Pelanggan')
@section('page_title', 'Kelola Pelanggan')
@section('breadcrumb', 'Pengguna / Kelola Pelanggan')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <p class="text-xs text-[#B8935A] tracking-[0.3em] uppercase mb-2">Pengguna</p>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Daftar Pelanggan
    </h2>
    <div class="gold-line mt-3"></div>
</div>

{{-- ════════════════════════ CUSTOMERS TABLE ════ --}}
<div class="card-luxury overflow-hidden">
    <div class="px-6 py-5 border-b border-[#EDE8DC] flex items-center justify-between">
        <div>
            <p class="text-xs text-[#B8935A] tracking-widest uppercase mb-1">Data Pengguna</p>
            <h3 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Semua Pelanggan</h3>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="btn-primary text-xs px-5 py-2.5 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pelanggan
        </a>
    </div>

    @if($customers->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-[#A89880]">
            <div class="w-10 h-px bg-[#DDD5C5] mb-6"></div>
            <p class="text-sm tracking-wider">Belum ada pelanggan terdaftar</p>
            <div class="w-10 h-px bg-[#DDD5C5] mt-6"></div>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr style="background-color: #FDFCF8;">
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-6 py-4 font-medium">Nama</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Email</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Total Reservasi</th>
                        <th class="text-left text-xs text-[#A89880] tracking-widest uppercase px-4 py-4 font-medium">Tgl Mendaftar</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#EDE8DC]">
                    @foreach($customers as $customer)
                        <tr class="hover:bg-[#FDFCF8] transition-colors">
                            <td class="px-6 py-4 font-medium text-[#2A1D14]">{{ $customer->name }}</td>
                            <td class="px-4 py-4 text-[#8C7B65]">{{ $customer->email }}</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center justify-center px-2.5 py-0.5 text-xs font-semibold tracking-wider text-[#2A1D14] bg-[#E8DCC4] border border-[#DDD5C5]">
                                    {{ $customer->reservations_count }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-[#8C7B65]">{{ $customer->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <a href="{{ route('admin.customers.edit', $customer) }}" 
                                   class="text-xs text-[#B8935A] hover:text-[#9E7A42] font-semibold tracking-wider uppercase transition-colors">
                                    Edit
                                </a>
                                <button type="button" 
                                        onclick="openLuxuryModal('{{ route('admin.customers.destroy', $customer) }}', 'DELETE', 'Hapus Pelanggan', 'Apakah Anda yakin ingin menghapus pelanggan {{ $customer->name }}? Seluruh riwayat reservasi yang bersangkutan akan terpengaruh.', 'Hapus')" 
                                        class="text-xs text-red-700 hover:text-red-900 font-semibold tracking-wider uppercase transition-colors">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($customers->hasPages())
            <div class="px-6 py-5 border-t border-[#EDE8DC] bg-[#FDFCF8] flex items-center justify-between">
                <div class="text-xs text-[#8C7B65]">
                    Menampilkan {{ $customers->firstItem() }} hingga {{ $customers->lastItem() }} dari {{ $customers->total() }} pelanggan
                </div>
                <div>
                    {{ $customers->links() }}
                </div>
            </div>
        @endif
    @endif
</div>
@endsection
