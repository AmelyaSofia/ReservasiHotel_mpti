@extends('layouts.admin')
@section('title', 'Detail Reservasi')
@section('page_title', 'Detail Reservasi')
@section('breadcrumb', 'Transaksi / Reservasi / Detail')

@section('content')
<div class="bg-white border border-[#EDE8DC] p-6 max-w-3xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">Reservasi #{{ $reservation->id }}</h2>
        <div>
            @if($reservation->status == 'pending') <span class="px-3 py-1 bg-orange-100 text-orange-700 text-xs font-bold uppercase tracking-widest rounded-full">Pending</span>
            @elseif($reservation->status == 'confirmed') <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-widest rounded-full">Confirmed</span>
            @elseif($reservation->status == 'completed') <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold uppercase tracking-widest rounded-full">Completed</span>
            @else <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold uppercase tracking-widest rounded-full">Cancelled</span>
            @endif
        </div>
    </div>
    
    <div class="grid grid-cols-2 gap-6 mb-8 text-sm">
        <div>
            <p class="text-[#705F4A] mb-1">Pelanggan</p>
            <p class="font-medium text-[#2A1D14]">{{ $reservation->user->name }}</p>
        </div>
        <div>
            <p class="text-[#705F4A] mb-1">Kamar</p>
            <p class="font-medium text-[#2A1D14]">{{ $reservation->room->room_number }} ({{ $reservation->room->roomType->name ?? '' }})</p>
        </div>
        <div>
            <p class="text-[#705F4A] mb-1">Check In</p>
            <p class="font-medium text-[#2A1D14]">{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('d F Y') }}</p>
        </div>
        <div>
            <p class="text-[#705F4A] mb-1">Check Out</p>
            <p class="font-medium text-[#2A1D14]">{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('d F Y') }}</p>
        </div>
        <div class="col-span-2">
            <p class="text-[#705F4A] mb-1">Total Harga</p>
            <p class="text-xl font-medium text-[#B8935A]">{{ 'Rp ' . number_format($reservation->total_price, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="border-t border-[#EDE8DC] pt-6 flex flex-wrap gap-3">
        @if($reservation->status == 'pending')
            <form action="{{ route('admin.reservations.confirm', $reservation) }}" method="POST">
                @csrf @method('PATCH')
                <button class="px-5 py-2 bg-blue-600 text-white text-xs font-bold tracking-widest uppercase hover:bg-blue-700">Konfirmasi Reservasi</button>
            </form>
        @endif
        
        @if($reservation->status == 'confirmed')
            <form action="{{ route('admin.reservations.complete', $reservation) }}" method="POST">
                @csrf @method('PATCH')
                <button class="px-5 py-2 bg-green-600 text-white text-xs font-bold tracking-widest uppercase hover:bg-green-700">Tandai Selesai</button>
            </form>
        @endif
        
        @if(in_array($reservation->status, ['pending', 'confirmed']))
            <button type="button" onclick="openLuxuryModal('{{ route('admin.reservations.cancel', $reservation) }}', 'PATCH', 'Batalkan Reservasi', 'Yakin membatalkan?', 'Batalkan Reservasi')" class="px-5 py-2 bg-red-600 text-white text-xs font-bold tracking-widest uppercase hover:bg-red-700">Batalkan Reservasi</button>
        @endif
        
        <a href="{{ route('admin.reservations.index') }}" class="px-5 py-2 bg-[#F7F4EE] text-[#705F4A] border border-[#EDE8DC] text-xs font-bold tracking-widest uppercase hover:bg-[#EDE8DC] ml-auto">Kembali</a>
    </div>
</div>
@endsection