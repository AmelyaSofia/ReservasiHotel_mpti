@extends('layouts.admin')

@section('title', 'Tambah Tipe Kamar')
@section('page_title', 'Tipe Kamar')
@section('breadcrumb', 'Master Data / Tipe Kamar / Tambah')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('admin.room-types.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Tipe Kamar
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Tambah Baru</span>
    </div>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Tambah Tipe Kamar Baru
    </h2>
    <div class="gold-line mt-3"></div>
</div>

{{-- ════════════════════════ FORM CONTAINER ════ --}}
<div class="card-luxury p-6 sm:p-8 max-w-2xl">
    <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 mb-6 font-semibold">
        Informasi Tipe Kamar
    </p>

    <form action="{{ route('admin.room-types.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="form-label">Nama Tipe Kamar <span class="text-red-700">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                   class="form-input-box @error('name') border-red-500 @enderror"
                   placeholder="Contoh: Standar, Deluxe, Suite">
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price_per_night" class="form-label">Harga Per Malam <span class="text-red-700">*</span></label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-xs text-[#8C7B65] font-semibold">Rp</span>
                <input type="number" name="price_per_night" id="price_per_night" value="{{ old('price_per_night') }}" required min="0" step="1000"
                       class="form-input-box pl-10 @error('price_per_night') border-red-500 @enderror"
                       placeholder="Contoh: 550000">
            </div>
            @error('price_per_night')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="form-label">Deskripsi <span class="text-red-700">*</span></label>
            <textarea name="description" id="description" rows="4"
                      class="form-input-box @error('description') border-red-500 @enderror"
                      placeholder="Deskripsikan keunggulan dan fasilitas utama tipe kamar ini...">{{ old('description') }}</textarea>
            @error('description')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4 border-t border-[#EDE8DC] flex items-center gap-3">
            <button type="submit" class="btn-primary py-2.5 px-6">
                Simpan Tipe Kamar
            </button>
            <a href="{{ route('admin.room-types.index') }}" class="btn-outline py-2.5 px-6">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection