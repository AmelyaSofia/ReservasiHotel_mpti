@extends('layouts.admin')
@section('title', 'Fasilitas')
@section('page_title', 'Fasilitas')
@section('breadcrumb', 'Master Data / Fasilitas')

@section('content')
<div class="bg-white border border-[#EDE8DC] p-6 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-medium text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif;">Daftar Fasilitas</h2>
        <a href="{{ route('admin.facilities.create') }}" class="px-4 py-2 bg-[#2A1D14] text-[#D4B896] text-sm tracking-widest uppercase hover:bg-[#1A1510] transition-colors">
            + Tambah Fasilitas
        </a>
    </div>

    <table class="w-full text-left text-sm whitespace-nowrap">
        <thead>
            <tr class="border-b border-[#EDE8DC] text-[#705F4A] tracking-wider uppercase text-xs">
                <th class="py-3 px-4 font-semibold">Nama Fasilitas</th>
                <th class="py-3 px-4 font-semibold text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#EDE8DC]">
            @forelse($facilities as $f)
                <tr class="hover:bg-[#F7F4EE] transition-colors">
                    <td class="py-4 px-4 font-medium text-[#2A1D14]">{{ $f->name }}</td>
                    <td class="py-4 px-4 text-right space-x-3">
                        <a href="{{ route('admin.facilities.edit', $f) }}" class="text-[#B8935A] hover:text-[#8C7B65] text-sm font-medium tracking-widest uppercase transition-colors">Edit</a>
                        <button type="button" onclick="openLuxuryModal('{{  route('admin.facilities.destroy', $f)  }}', 'DELETE', 'Hapus Fasilitas', 'Yakin hapus?', 'Hapus')" class="text-red-500 hover:text-red-700 text-sm font-medium tracking-widest uppercase transition-colors">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2" class="py-8 text-center text-[#8C7B65]">Belum ada data fasilitas.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-6">{{ $facilities->links() }}</div>
</div>
@endsection