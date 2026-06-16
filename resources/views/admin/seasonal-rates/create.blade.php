@extends('layouts.admin')

@section('title', 'Tambah Harga Dinamis')
@section('page_title', 'Tambah Harga Dinamis')
@section('breadcrumb', 'Manajemen Harga > Tambah')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-[#EDE8DC] max-w-2xl mx-auto">
    <div class="p-6 bg-white border-b border-[#EDE8DC]">
        <form method="POST" action="{{ route('admin.seasonal-rates.store') }}">
            @csrf

            <div class="mb-4">
                <label for="room_type_id" class="block text-sm font-medium text-[#2A1D14]">Tipe Kamar</label>
                <select name="room_type_id" id="room_type_id" class="mt-1 block w-full border-[#EDE8DC] rounded-md shadow-sm focus:ring-[#B8935A] focus:border-[#B8935A] sm:text-sm" required>
                    <option value="">-- Pilih Tipe Kamar --</option>
                    @foreach($roomTypes as $rt)
                        <option value="{{ $rt->id }}">{{ $rt->name }} (Normal: Rp {{ number_format($rt->price_per_night, 0, ',', '.') }})</option>
                    @endforeach
                </select>
                @error('room_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-[#2A1D14]">Mulai Tanggal</label>
                    <input type="date" name="start_date" id="start_date" class="mt-1 block w-full border-[#EDE8DC] rounded-md shadow-sm focus:ring-[#B8935A] focus:border-[#B8935A] sm:text-sm" required>
                    @error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-[#2A1D14]">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date" class="mt-1 block w-full border-[#EDE8DC] rounded-md shadow-sm focus:ring-[#B8935A] focus:border-[#B8935A] sm:text-sm" required>
                    @error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="price_per_night" class="block text-sm font-medium text-[#2A1D14]">Harga per Malam Baru (Rp)</label>
                <input type="number" name="price_per_night" id="price_per_night" class="mt-1 block w-full border-[#EDE8DC] rounded-md shadow-sm focus:ring-[#B8935A] focus:border-[#B8935A] sm:text-sm" placeholder="Contoh: 300000" required>
                <p class="text-xs text-gray-500 mt-1">Harga ini akan menggantikan harga normal kamar pada rentang tanggal di atas.</p>
                @error('price_per_night') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-[#2A1D14]">Keterangan (Opsional)</label>
                <input type="text" name="description" id="description" class="mt-1 block w-full border-[#EDE8DC] rounded-md shadow-sm focus:ring-[#B8935A] focus:border-[#B8935A] sm:text-sm" placeholder="Misal: Promo Akhir Tahun / Low Season">
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end">
                <a href="{{ route('admin.seasonal-rates.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#2A1D14] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1A1510] active:bg-[#1A1510] focus:outline-none focus:border-[#1A1510] focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Simpan Harga
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
