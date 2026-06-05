@extends('layouts.admin')

@section('title', 'Kelola Pelanggan')
@section('page_title', 'Kelola Pelanggan')
@section('breadcrumb', 'Pengguna / Kelola Pelanggan')

@section('content')
<div class="bg-white border border-[#EDE8DC] p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-medium text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">Daftar Pelanggan</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead>
                <tr class="border-b border-[#EDE8DC] text-[#705F4A] tracking-wider uppercase text-xs">
                    <th class="py-3 px-4 font-semibold">Nama</th>
                    <th class="py-3 px-4 font-semibold">Email</th>
                    <th class="py-3 px-4 font-semibold">Total Reservasi</th>
                    <th class="py-3 px-4 font-semibold">Tgl Mendaftar</th>
                    <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#EDE8DC]">
                @forelse($customers as $customer)
                    <tr class="hover:bg-[#F7F4EE] transition-colors">
                        <td class="py-4 px-4">
                            <p class="font-medium text-[#2A1D14]">{{ $customer->name }}</p>
                        </td>
                        <td class="py-4 px-4 text-[#8C7B65]">{{ $customer->email }}</td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-[#2A1D14] bg-[#E8DCC4] rounded-full">
                                {{ $customer->reservations_count }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-[#8C7B65]">{{ $customer->created_at->format('d M Y') }}</td>
                        <td class="py-4 px-4 text-right">
                            <button type="button" onclick="openLuxuryModal('{{  route('admin.customers.destroy', $customer)  }}', 'DELETE', 'Hapus Pelanggan', 'Apakah Anda yakin ingin menghapus pelanggan ini?', 'Hapus')" class="text-red-500 hover:text-red-700 text-sm font-medium tracking-widest uppercase transition-colors">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-[#8C7B65]">
                            Belum ada pelanggan terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $customers->links() }}
    </div>
</div>
@endsection
