@extends('layouts.admin')

@section('title', 'Ubah Pelanggan')
@section('page_title', 'Pelanggan')
@section('breadcrumb', 'Pengguna / Pelanggan / Ubah')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('admin.customers.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Pelanggan
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Ubah Pelanggan</span>
    </div>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Ubah Data Pelanggan
    </h2>
    <div class="gold-line mt-3"></div>
</div>

<div class="card-luxury p-6 sm:p-8 max-w-xl">
    <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 mb-5 font-semibold">
        Informasi Pelanggan
    </p>

    <form action="{{ route('admin.customers.update', $customer) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="form-label">Nama Pelanggan <span class="text-red-700">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $customer->name) }}" required 
                   class="form-input-box @error('name') border-red-500 @enderror" 
                   placeholder="Contoh: Budi Santoso">
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="form-label">Alamat Email <span class="text-red-700">*</span></label>
            <input type="email" name="email" id="email" value="{{ old('email', $customer->email) }}" required 
                   class="form-input-box @error('email') border-red-500 @enderror" 
                   placeholder="Contoh: budi@example.com">
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="form-label">Password <span class="text-xs text-[#8C7B65] font-normal tracking-normal">(Kosongkan jika tidak ingin diubah)</span></label>
            <input type="password" name="password" id="password" 
                   class="form-input-box @error('password') border-red-500 @enderror" 
                   placeholder="Minimal 8 karakter">
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                   class="form-input-box" 
                   placeholder="Masukkan kembali password baru">
        </div>

        <div class="pt-4 flex items-center gap-3">
            <button type="submit" class="btn-primary py-2.5 px-6">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.customers.index') }}" class="btn-outline py-2.5 px-6">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
