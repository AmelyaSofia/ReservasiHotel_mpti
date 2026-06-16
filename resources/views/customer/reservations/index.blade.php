@extends('layouts.customer')

@section('title', 'Reservasi Saya')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <p class="text-xs text-[#B8935A] tracking-[0.3em] uppercase mb-2">Riwayat Transaksi</p>
        <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
            Reservasi Saya
        </h2>
        <div class="gold-line mt-3"></div>
    </div>
    <div>
        <a href="{{ route('customer.catalog.index') }}" class="btn-primary flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Pesan Kamar Lain
        </a>
    </div>
</div>

{{-- ════════════════════════ RESERVATION LIST ════ --}}
@if($reservations->isEmpty())
    {{-- Empty State --}}
    <div class="card-luxury py-20 flex flex-col items-center justify-center text-[#A89880]">
        <div class="w-12 h-px bg-[#DDD5C5] mb-6"></div>
        <svg class="w-12 h-12 opacity-30 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
        </svg>
        <p class="text-sm tracking-wider font-semibold uppercase">Belum Ada Reservasi</p>
        <p class="text-xs text-[#8C7B65] mt-2 mb-6">Anda belum memiliki riwayat pemesanan kamar.</p>
        <a href="{{ route('customer.catalog.index') }}" class="btn-primary text-xs px-8 py-3">
            Mulai Pesan Kamar
        </a>
        <div class="w-12 h-px bg-[#DDD5C5] mt-6"></div>
    </div>
@else
    <div class="space-y-4 mb-8">
        @foreach($reservations as $reservasi)
            @php
                // Border accent based on status
                $statusColor = 'border-l-amber-500'; // pending
                if ($reservasi->status === 'confirmed') {
                    $statusColor = 'border-l-stone-500';
                } elseif ($reservasi->status === 'completed') {
                    $statusColor = 'border-l-gold-500';
                } elseif ($reservasi->status === 'cancelled') {
                    $statusColor = 'border-l-red-500';
                }
            @endphp
            
            <div class="card-luxury border-l-4 {{ $statusColor }} bg-white p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 hover:border-r-[#EDE8DC] hover:shadow-sm transition-all duration-200 group">
                
                {{-- Room info & dates --}}
                <div class="flex items-start gap-4">
                    {{-- Mini Icon/Badge --}}
                    <div class="w-10 h-10 bg-[#F7F4EE] border border-[#EDE8DC] flex items-center justify-center text-[#B8935A] shrink-0 font-serif text-sm">
                        {{ $reservasi->room->room_number }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-sm font-semibold text-[#2A1D14]">Suite {{ $reservasi->room->room_number }}</h3>
                            <span class="text-[#DDD5C5] text-xs">·</span>
                            <span class="text-xs text-[#8C7B65] tracking-wide">{{ $reservasi->room->roomType->name }}</span>
                        </div>
                        
                        <p class="text-xs text-[#8C7B65] mt-1 flex items-center gap-1.5 flex-wrap">
                            <svg class="w-3.5 h-3.5 text-[#A89880]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
                            </svg>
                            <span>{{ $reservasi->check_in_date->format('d M') }} — {{ $reservasi->check_out_date->format('d M Y') }}</span>
                            <span class="text-[#DDD5C5]">·</span>
                            <span>{{ $reservasi->nights }} Malam</span>
                        </p>
                    </div>
                </div>

                {{-- Price & status --}}
                <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center w-full sm:w-auto border-t sm:border-0 border-[#F7F4EE] pt-3 sm:pt-0 gap-2 shrink-0">
                    <div>
                        @php
                            $bm = [
                                'pending'   => 'badge-pending',
                                'confirmed' => 'badge-confirmed',
                                'completed' => 'badge-completed',
                                'cancelled' => 'badge-cancelled',
                            ];
                            $lm = [
                                'pending'   => 'Pending',
                                'confirmed' => 'Dikonfirmasi',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ];
                        @endphp
                        <span class="badge {{ $bm[$reservasi->status] ?? '' }}">
                            {{ $lm[$reservasi->status] ?? $reservasi->status }}
                        </span>
                    </div>
                    <div>
                        @php
                            $pricePerNight = $reservasi->nights > 0 ? $reservasi->total_price / $reservasi->nights : 0;
                            $isPromo = $pricePerNight < $reservasi->room->roomType->price_per_night;
                        @endphp
                        <div class="flex items-center justify-start sm:justify-end gap-1.5 mb-0.5">
                            <p class="text-xs text-[#8C7B65] tracking-widest">Total Biaya</p>
                            @if($isPromo)
                                <span class="bg-[#8C2323] text-white text-[8px] px-1 py-0.5 rounded uppercase tracking-wider font-sans font-normal">Promo</span>
                            @endif
                        </div>
                        <p class="text-sm font-semibold text-[#2A1D14] sm:text-right">
                            Rp {{ number_format($reservasi->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3 w-full sm:w-auto border-t sm:border-0 border-[#F7F4EE] pt-3 sm:pt-0 shrink-0">
                    <a href="{{ route('customer.reservations.show', $reservasi) }}" class="flex-1 sm:flex-initial btn-outline py-2 px-4 text-xs text-center tracking-wider font-medium">
                        Detail
                    </a>

                    @if($reservasi->status === 'pending')
                        <div class="flex-1 sm:flex-initial">
                            <button type="button" onclick="openLuxuryModal('{{ route('customer.reservations.cancel', $reservasi) }}', 'PATCH', 'Batalkan Reservasi', 'Apakah Anda yakin ingin membatalkan reservasi ini? Tindakan ini tidak dapat diurungkan dan kamar akan kembali tersedia untuk pelanggan lain.', 'Batalkan Reservasi')" class="w-full py-2 px-4 text-xs text-center tracking-wider font-medium bg-red-700/10 text-red-800 hover:bg-red-800 hover:text-white border border-red-200 transition-colors">
                                Batalkan
                            </button>
                        </div>
                    @endif
                </div>

            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($reservations->hasPages())
        <div class="px-6 py-5 border border-[#EDE8DC] bg-white flex items-center justify-between">
            <div class="text-xs text-[#8C7B65]">
                Menampilkan {{ $reservations->firstItem() }} hingga {{ $reservations->lastItem() }} dari {{ $reservations->total() }} reservasi
            </div>
            <div>
                {{ $reservations->links() }}
            </div>
        </div>
    @endif
@endif



@endsection
