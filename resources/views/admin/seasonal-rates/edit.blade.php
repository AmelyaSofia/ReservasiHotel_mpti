@extends('layouts.admin')

@section('title', 'Edit Harga Dinamis')
@section('page_title', 'Harga Dinamis')
@section('breadcrumb', 'Master Data / Harga Dinamis / Edit')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('admin.seasonal-rates.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Harga Dinamis
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Edit Harga</span>
    </div>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Ubah Data Harga Dinamis
    </h2>
    <div class="gold-line mt-3"></div>
</div>

{{-- ════════════════════════ FORM CONTAINER ════ --}}
<div class="card-luxury p-6 sm:p-8 max-w-2xl">
    <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 mb-6 font-semibold">
        Informasi Harga Musiman
    </p>

    <form method="POST" action="{{ route('admin.seasonal-rates.update', $seasonalRate) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="room_type_id" class="form-label">Tipe Kamar <span class="text-red-700">*</span></label>
            <select name="room_type_id" id="room_type_id" required
                    class="form-input-box @error('room_type_id') border-red-500 @enderror">
                <option value="">— Pilih Tipe Kamar —</option>
                @foreach($roomTypes as $rt)
                    <option value="{{ $rt->id }}" {{ old('room_type_id', $seasonalRate->room_type_id) == $rt->id ? 'selected' : '' }}>
                        {{ $rt->name }} (Normal: Rp {{ number_format($rt->price_per_night, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
            @error('room_type_id')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="start_date" class="form-label">Mulai Tanggal <span class="text-red-700">*</span></label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $seasonalRate->start_date->format('Y-m-d')) }}" required
                       class="form-input-box @error('start_date') border-red-500 @enderror">
                @error('start_date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="end_date" class="form-label">Sampai Tanggal <span class="text-red-700">*</span></label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $seasonalRate->end_date->format('Y-m-d')) }}" required
                       class="form-input-box @error('end_date') border-red-500 @enderror">
                @error('end_date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="price_per_night" class="form-label">Harga Per Malam Baru <span class="text-red-700">*</span></label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-xs text-[#8C7B65] font-semibold">Rp</span>
                <input type="number" name="price_per_night" id="price_per_night" value="{{ old('price_per_night', (int) $seasonalRate->price_per_night) }}" required min="0" step="1000"
                       class="form-input-box pl-10 @error('price_per_night') border-red-500 @enderror"
                       placeholder="Contoh: 300000">
            </div>
            @error('price_per_night')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="form-label">Keterangan <span class="text-xs text-[#8C7B65] font-normal tracking-normal">(Opsional)</span></label>
            <input type="text" name="description" id="description" value="{{ old('description', $seasonalRate->description) }}"
                   class="form-input-box @error('description') border-red-500 @enderror"
                   placeholder="Misal: Promo Akhir Tahun / Low Season / Libur Lebaran">
            @error('description')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4 border-t border-[#EDE8DC] flex items-center gap-3">
            <button type="submit" class="btn-primary py-2.5 px-6">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.seasonal-rates.index') }}" class="btn-outline py-2.5 px-6">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
