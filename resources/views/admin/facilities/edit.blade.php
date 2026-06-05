@extends('layouts.admin')
@section('title', 'Edit Fasilitas')
@section('page_title', 'Edit Fasilitas')
@section('breadcrumb', 'Master Data / Fasilitas / Edit')

@section('content')
<div class="bg-white border border-[#EDE8DC] p-6 max-w-lg">
    <form action="{{ route('admin.facilities.update', $facility) }}" method="POST" class="space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium text-[#705F4A] mb-1">Nama Fasilitas</label>
            <input type="text" name="name" value="{{ old('name', $facility->name) }}" required class="w-full border-[#EDE8DC] focus:ring-[#B8935A] focus:border-[#B8935A]">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="pt-4 flex gap-3">
            <button type="submit" class="px-6 py-2 bg-[#B8935A] text-white text-sm tracking-widest uppercase hover:bg-[#8C7B65] transition-colors">Simpan</button>
            <a href="{{ route('admin.facilities.index') }}" class="px-6 py-2 bg-[#F7F4EE] text-[#705F4A] border border-[#EDE8DC] text-sm tracking-widest uppercase hover:bg-[#EDE8DC] transition-colors">Batal</a>
        </div>
    </form>
</div>
@endsection