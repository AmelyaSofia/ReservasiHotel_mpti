@extends('layouts.admin')
@section('title', 'Tipe Kamar')
@section('page_title', 'Tipe Kamar')
@section('breadcrumb', 'Master Data / Tipe Kamar')

@section('content')
<div class="bg-white border border-[#EDE8DC] p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-medium text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">Daftar Tipe Kamar</h2>
        <a href="{{ route('admin.room-types.create') }}" class="px-4 py-2 bg-[#2A1D14] text-[#D4B896] text-sm tracking-widest uppercase hover:bg-[#1A1510] transition-colors">
            + Tambah Tipe Kamar
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead>
                <tr class="border-b border-[#EDE8DC] text-[#705F4A] tracking-wider uppercase text-xs">
                    <th class="py-3 px-4 font-semibold">Nama Tipe</th>
                    <th class="py-3 px-4 font-semibold">Harga / Malam</th>
                    <th class="py-3 px-4 font-semibold">Total Kamar</th>
                    <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#EDE8DC]">
                @forelse($roomTypes as $rt)
                    <tr class="hover:bg-[#F7F4EE] transition-colors">
                        <td class="py-4 px-4 font-medium text-[#2A1D14]">{{ $rt->name }}</td>
                        <td class="py-4 px-4 text-[#8C7B65]">{{ 'Rp ' . number_format($rt->price_per_night, 0, ',', '.') }}</td>
                        <td class="py-4 px-4 text-[#8C7B65]">{{ $rt->rooms_count ?? 0 }} Kamar</td>
                        <td class="py-4 px-4 text-right space-x-2">
                            <a href="{{ route('admin.room-types.show', $rt) }}" class="text-[#8C7B65] hover:text-[#2A1D14] text-sm font-medium tracking-widest uppercase transition-colors">Lihat</a>
                            <a href="{{ route('admin.room-types.edit', $rt) }}" class="text-[#B8935A] hover:text-[#8C7B65] text-sm font-medium tracking-widest uppercase transition-colors">Edit</a>
                            <button type="button" onclick="openLuxuryModal('{{  route('admin.room-types.destroy', $rt)  }}', 'DELETE', 'Hapus Tipe Kamar', 'Yakin hapus?', 'Hapus')" class="text-red-500 hover:text-red-700 text-sm font-medium tracking-widest uppercase transition-colors">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="py-8 text-center text-[#8C7B65]">Belum ada data tipe kamar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $roomTypes->links() }}</div>
</div>
@endsection