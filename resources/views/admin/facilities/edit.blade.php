@extends('layouts.admin')

@section('title', 'Ubah Fasilitas')
@section('page_title', 'Fasilitas')
@section('breadcrumb', 'Master Data / Fasilitas / Ubah')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('admin.facilities.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Fasilitas
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Ubah Fasilitas</span>
    </div>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Ubah Data Fasilitas
    </h2>
    <div class="gold-line mt-3"></div>
</div>

{{-- ════════════════════════ FORM CONTAINER ════ --}}
<div class="card-luxury p-6 sm:p-8 max-w-xl">
    <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 mb-5 font-semibold">
        Informasi Fasilitas
    </p>

    <form action="{{ route('admin.facilities.update', $facility) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="form-label">Nama Fasilitas <span class="text-red-700">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $facility->name) }}" required 
                   class="form-input-box @error('name') border-red-500 @enderror" 
                   placeholder="Contoh: WiFi Kecepatan Tinggi, AC, Bathub">
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4 flex items-center gap-3">
            <button type="submit" class="btn-primary py-2.5 px-6">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.facilities.index') }}" class="btn-outline py-2.5 px-6">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection