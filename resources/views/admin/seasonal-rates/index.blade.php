@extends('layouts.admin')

@section('title', 'Daftar Harga Dinamis')
@section('page_title', 'Harga Dinamis')
@section('breadcrumb', 'Manajemen Harga Musiman / Dinamis')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-lg font-semibold text-[#2A1D14]">Daftar Harga Dinamis</h2>
    <a href="{{ route('admin.seasonal-rates.create') }}" 
       class="inline-flex items-center px-4 py-2 bg-[#8C7B65] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#705F4A] active:bg-[#5C4A35] focus:outline-none focus:border-[#5C4A35] focus:ring ring-[#A89880] disabled:opacity-25 transition ease-in-out duration-150">
        Tambah Harga Baru
    </a>
</div>

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-[#EDE8DC]">
    <div class="p-6 bg-white border-b border-[#EDE8DC]">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-[#8C7B65] uppercase bg-[#F7F4EE] border-b border-[#EDE8DC]">
                <tr>
                    <th scope="col" class="px-6 py-3">Tipe Kamar</th>
                    <th scope="col" class="px-6 py-3">Mulai Tanggal</th>
                    <th scope="col" class="px-6 py-3">Sampai Tanggal</th>
                    <th scope="col" class="px-6 py-3">Harga per Malam</th>
                    <th scope="col" class="px-6 py-3">Keterangan</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rates as $rate)
                    <tr class="bg-white border-b border-[#EDE8DC] hover:bg-[#FDFCF8]">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $rate->roomType->name }}</td>
                        <td class="px-6 py-4">{{ $rate->start_date->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ $rate->end_date->format('d M Y') }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($rate->price_per_night, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $rate->description }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.seasonal-rates.edit', $rate) }}" class="text-blue-600 hover:underline">Edit</a>
                            <button onclick="openLuxuryModal('{{ route('admin.seasonal-rates.destroy', $rate) }}', 'DELETE', 'Hapus Harga', 'Yakin ingin menghapus harga dinamis ini?', 'Hapus')" class="text-red-600 hover:underline">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data harga dinamis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $rates->links() }}
        </div>
    </div>
</div>
@endsection
