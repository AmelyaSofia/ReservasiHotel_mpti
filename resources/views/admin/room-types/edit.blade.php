@extends('layouts.admin')
@section('title', 'Edit Tipe Kamar')
@section('page_title', 'Edit Tipe Kamar')
@section('breadcrumb', 'Master Data / Tipe Kamar / Edit')

@section('content')
<div class="bg-white border border-[#EDE8DC] p-6 max-w-2xl">
    <form action="{{ route('admin.room-types.update', $roomType) }}" method="POST" class="space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-[#705F4A] mb-1">Nama Tipe Kamar</label>
            <input type="text" name="name" value="{{ old('name', $roomType->name) }}" required class="w-full border-[#EDE8DC] focus:ring-[#B8935A] focus:border-[#B8935A]">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-[#705F4A] mb-1">Harga Per Malam (Rp)</label>
            <input type="number" name="price_per_night" value="{{ old('price_per_night', $roomType->price_per_night) }}" required class="w-full border-[#EDE8DC] focus:ring-[#B8935A] focus:border-[#B8935A]">
            @error('price_per_night')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-[#705F4A] mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border-[#EDE8DC] focus:ring-[#B8935A] focus:border-[#B8935A]">{{ old('description', $roomType->description) }}</textarea>
            @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="pt-4 flex gap-3">
            <button type="submit" class="px-6 py-2 bg-[#B8935A] text-white text-sm tracking-widest uppercase hover:bg-[#8C7B65] transition-colors">Simpan Perubahan</button>
            <a href="{{ route('admin.room-types.index') }}" class="px-6 py-2 bg-[#F7F4EE] text-[#705F4A] border border-[#EDE8DC] text-sm tracking-widest uppercase hover:bg-[#EDE8DC] transition-colors">Batal</a>
        </div>
    </form>
</div>
@endsection