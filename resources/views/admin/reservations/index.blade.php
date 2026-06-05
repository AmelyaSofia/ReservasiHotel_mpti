@extends('layouts.admin')
@section('title', 'Kelola Reservasi')
@section('page_title', 'Kelola Reservasi')
@section('breadcrumb', 'Transaksi / Reservasi')

@section('content')
<div class="bg-white border border-[#EDE8DC] p-6">
    <table class="w-full text-left text-sm whitespace-nowrap">
        <thead>
            <tr class="border-b border-[#EDE8DC] text-[#705F4A] tracking-wider uppercase text-xs">
                <th class="py-3 px-4 font-semibold">ID</th>
                <th class="py-3 px-4 font-semibold">Pelanggan</th>
                <th class="py-3 px-4 font-semibold">Kamar</th>
                <th class="py-3 px-4 font-semibold">Check In/Out</th>
                <th class="py-3 px-4 font-semibold">Total Harga</th>
                <th class="py-3 px-4 font-semibold">Status</th>
                <th class="py-3 px-4 font-semibold text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[#EDE8DC]">
            @forelse($reservations as $r)
                <tr class="hover:bg-[#F7F4EE] transition-colors">
                    <td class="py-4 px-4 font-medium">#{{ $r->id }}</td>
                    <td class="py-4 px-4">{{ $r->user->name ?? '-' }}</td>
                    <td class="py-4 px-4">{{ $r->room->room_number ?? '-' }}</td>
                    <td class="py-4 px-4 text-[#8C7B65]">
                        {{ \Carbon\Carbon::parse($r->check_in_date)->format('d M y') }} - 
                        {{ \Carbon\Carbon::parse($r->check_out_date)->format('d M y') }}
                    </td>
                    <td class="py-4 px-4 text-[#8C7B65]">{{ 'Rp ' . number_format($r->total_price, 0, ',', '.') }}</td>
                    <td class="py-4 px-4">
                        @if($r->status == 'pending') <span class="text-orange-500 font-bold uppercase text-xs tracking-wider">Pending</span>
                        @elseif($r->status == 'confirmed') <span class="text-blue-500 font-bold uppercase text-xs tracking-wider">Confirmed</span>
                        @elseif($r->status == 'completed') <span class="text-green-500 font-bold uppercase text-xs tracking-wider">Completed</span>
                        @else <span class="text-red-500 font-bold uppercase text-xs tracking-wider">Cancelled</span>
                        @endif
                    </td>
                    <td class="py-4 px-4 text-right space-x-2">
                        <a href="{{ route('admin.reservations.show', $r) }}" class="text-[#B8935A] hover:text-[#2A1D14] text-sm font-medium tracking-widest uppercase">Lihat</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="py-8 text-center text-[#8C7B65]">Belum ada data reservasi.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-6">{{ $reservations->links() }}</div>
</div>
@endsection