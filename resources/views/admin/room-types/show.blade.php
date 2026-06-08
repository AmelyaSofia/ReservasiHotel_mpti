@extends('layouts.admin')
@section('title', 'Detail Tipe Kamar')
@section('page_title', 'Detail Tipe Kamar')
@section('breadcrumb', 'Master Data / Tipe Kamar / Detail')

@section('content')
<div class="bg-white border border-[#EDE8DC] p-6 mb-6">
    <h2 class="text-xl font-light text-[#2A1D14] mb-2" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">{{ $roomType->name }}</h2>
    <p class="text-[#8C7B65] mb-4 text-lg">{{ 'Rp ' . number_format($roomType->price_per_night, 0, ',', '.') }} / malam</p>
    <div class="prose max-w-none text-[#705F4A] mb-6">
        {{ $roomType->description ?? 'Tidak ada deskripsi.' }}
    </div>
    <a href="{{ route('admin.room-types.index') }}" class="text-[#B8935A] hover:text-[#2A1D14] text-sm font-medium tracking-widest uppercase transition-colors">← Kembali</a>
</div>
@endsection