@extends('layouts.customer')

@section('title', 'Voucher Reservasi #' . $reservation->id)

@section('content')

{{-- ════════════════════════ BREADCRUMBS & NAVIGATION ════ --}}
<div class="mb-8 flex items-center justify-between flex-wrap gap-4">
    <div class="flex items-center gap-2">
        <a href="{{ route('customer.dashboard') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Beranda
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <a href="{{ route('customer.reservations.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Reservasi Saya
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Voucher #{{ $reservation->id }}</span>
    </div>
    <a href="{{ route('customer.reservations.index') }}" class="text-xs text-[#B8935A] tracking-widest uppercase hover:text-[#9E7A42] transition-colors flex items-center gap-1.5 font-medium">
        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
        </svg>
        Kembali ke Riwayat
    </a>
</div>

{{-- ════════════════════════ VOUCHER CONTEXT ════ --}}
<div class="max-w-3xl mx-auto space-y-6">

    {{-- VOUCHER CARD --}}
    <div class="card-luxury overflow-hidden bg-white shadow-lg border-2 border-[#EDE8DC] relative">
        {{-- Luxury dashed tear-line indicator on sides --}}
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-3 h-6 bg-[#F7F4EE] border-r border-[#EDE8DC] rounded-r-full hidden sm:block"></div>
        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-3 h-6 bg-[#F7F4EE] border-l border-[#EDE8DC] rounded-l-full hidden sm:block"></div>

        {{-- Voucher Header --}}
        <div class="px-6 py-8 border-b-2 border-dashed border-[#EDE8DC] text-center" style="background: linear-gradient(180deg, #FDFCF8 0%, #F7F4EE 100%);">
            <div class="flex items-center justify-center gap-2 mb-2">
                <div class="w-10 h-px bg-[#B8935A]"></div>
                <p class="text-[10px] text-[#B8935A] tracking-[0.35em] uppercase font-semibold">Luxury Collection</p>
                <div class="w-10 h-px bg-[#B8935A]"></div>
            </div>
            <h2 class="text-2xl font-light text-[#2A1D14] tracking-wide" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
                Royal Crown <em class="text-[#B8935A]">Hotel</em>
            </h2>
            <p class="text-xs text-[#8C7B65] tracking-[0.2em] uppercase font-medium mt-1">Reservation Voucher</p>
            
            <div class="mt-4 inline-flex items-center gap-2 px-3.5 py-1 border border-[#DDD5C5] bg-white">
                <span class="text-[10px] text-[#A89880] tracking-wider uppercase">Booking ID:</span>
                <span class="text-xs font-bold text-[#2A1D14]">#RC-{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        {{-- Voucher Content --}}
        <div class="p-6 sm:p-8 space-y-8">
            
            {{-- Grid details --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- Stay Information --}}
                <div class="space-y-4">
                    <p class="text-[10px] text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-2 font-bold">Rincian Menginap</p>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] text-[#8C7B65] uppercase tracking-wider">Tanggal Check-in</p>
                            <p class="text-sm font-semibold text-[#2A1D14] mt-1">{{ $reservation->check_in_date->format('d M Y') }}</p>
                            <p class="text-[10px] text-[#A89880] mt-0.5">Dari jam 14:00</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-[#8C7B65] uppercase tracking-wider">Tanggal Check-out</p>
                            <p class="text-sm font-semibold text-[#2A1D14] mt-1">{{ $reservation->check_out_date->format('d M Y') }}</p>
                            <p class="text-[10px] text-[#A89880] mt-0.5">Sebelum jam 12:00</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center bg-[#F7F4EE] border border-[#EDE8DC] p-3 mt-2">
                        <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Durasi Menginap</span>
                        <span class="text-sm font-semibold text-[#2A1D14]">{{ $reservation->nights }} Malam</span>
                    </div>
                </div>

                {{-- Room & Price details --}}
                <div class="space-y-4">
                    <p class="text-[10px] text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-2 font-bold">Rincian Akomodasi</p>
                    
                    <div>
                        <p class="text-[10px] text-[#8C7B65] uppercase tracking-wider">Kamar & Tipe</p>
                        <p class="text-sm font-semibold text-[#2A1D14] mt-1">Suite {{ $reservation->room->room_number }}</p>
                        <p class="text-xs text-[#8C7B65] mt-0.5">{{ $reservation->room->roomType->name }} (Maks. {{ $reservation->room->capacity }} Tamu)</p>
                    </div>

                    <div class="flex justify-between items-center bg-[#F7F4EE] border border-[#EDE8DC] p-3">
                        <span class="text-xs text-[#8C7B65] uppercase tracking-wider">Status Pemesanan</span>
                        @php
                            $bm = ['pending'=>'badge-pending','confirmed'=>'badge-confirmed','completed'=>'badge-completed','cancelled'=>'badge-cancelled'];
                            $lm = ['pending'=>'Pending','confirmed'=>'Dikonfirmasi','completed'=>'Selesai','cancelled'=>'Dibatalkan'];
                        @endphp
                        <span class="badge {{ $bm[$reservation->status] ?? '' }}">
                            {{ $lm[$reservation->status] ?? $reservation->status }}
                        </span>
                    </div>
                </div>

            </div>

            {{-- Guest details --}}
            <div class="border-t border-[#EDE8DC] pt-6 space-y-4">
                <p class="text-[10px] text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-2 font-bold">Informasi Tamu</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <span class="text-[10px] text-[#8C7B65] uppercase tracking-wider">Nama Tamu Utama</span>
                        <p class="text-sm font-semibold text-[#2A1D14] mt-1">{{ $reservation->user->name }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] text-[#8C7B65] uppercase tracking-wider">Alamat Email</span>
                        <p class="text-sm font-semibold text-[#2A1D14] mt-1">{{ $reservation->user->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Total Cost & Payment terms --}}
            <div class="border-t border-[#EDE8DC] pt-6 bg-[#FDFCF8] border border-[#EDE8DC] p-6 space-y-4">
                @php
                    $pricePerNight = $reservation->nights > 0 ? $reservation->total_price / $reservation->nights : 0;
                    $isPromo = $pricePerNight < $reservation->room->roomType->price_per_night;
                @endphp
                <div class="flex justify-between items-center">
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="text-[10px] text-[#8C7B65] uppercase tracking-widest font-semibold">Total Biaya</p>
                            @if($isPromo)
                                <span class="bg-[#8C2323] text-white text-[8px] px-1.5 py-0.5 rounded uppercase tracking-wider font-sans font-normal">Harga Promo</span>
                            @endif
                        </div>
                        <p class="text-[10px] text-[#A89880] mt-0.5">Sudah termasuk pajak & biaya layanan</p>
                    </div>
                    <div class="text-right">
                        @if($isPromo)
                            <p class="text-[10px] text-[#A89880] line-through mb-0.5">Rp {{ number_format($reservation->room->roomType->price_per_night * $reservation->nights, 0, ',', '.') }}</p>
                        @endif
                        <span class="text-xl font-bold text-[#B8935A] font-serif">
                            Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                
                <div class="border-t border-[#EDE8DC] pt-3.5 flex items-start gap-2.5 text-xs text-[#8C7B65] leading-relaxed">
                    <svg class="w-4 h-4 text-[#B8935A] shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <span class="font-bold text-[#5C4033] uppercase text-[9px] tracking-wider block mb-0.5">Metode Pembayaran</span>
                        Selesaikan pembayaran dengan mudah secara Online melalui berbagai metode (Transfer Bank, E-Wallet, Kartu Kredit).
                        <div class="mt-2 text-[#B8935A] font-medium text-xs">
                            Status Pembayaran: <span class="uppercase tracking-wider font-bold border-b border-[#B8935A]">{{ $reservation->payment_status }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer terms --}}
        <div class="px-6 py-5 border-t border-[#EDE8DC] bg-[#F7F4EE] text-center">
            <p class="text-[10px] text-[#A89880] tracking-widest uppercase font-medium">
                Terima Kasih Telah Memilih Royal Crown Hotel
            </p>
        </div>
    </div>

    {{-- Actions under card --}}
    @if($reservation->status === 'pending')
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            @if($reservation->payment_status === 'unpaid' && $reservation->snap_token)
            <div class="w-full max-w-xs">
                <button type="button" id="pay-button" class="w-full py-3.5 flex items-center justify-center gap-2 shadow-md bg-[#2A1D14] hover:bg-[#1A120C] text-white font-semibold text-sm tracking-widest uppercase transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                    Bayar Sekarang
                </button>
            </div>
            @endif

            <div class="w-full max-w-xs">
                <button type="button" onclick="openLuxuryModal('{{ route('customer.reservations.cancel', $reservation) }}', 'PATCH', 'Batalkan Reservasi', 'Apakah Anda yakin ingin membatalkan reservasi ini? Tindakan ini tidak dapat diurungkan dan kamar akan kembali tersedia untuk pelanggan lain.', 'Batalkan Reservasi')" class="w-full py-3.5 flex items-center justify-center gap-2 shadow-sm bg-red-700 hover:bg-red-800 text-white font-semibold text-sm tracking-widest uppercase transition-colors border border-red-800">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Batalkan Reservasi
                </button>
            </div>
        </div>
    @endif

</div>



@endsection

@if($reservation->status === 'pending' && $reservation->snap_token && $reservation->payment_status === 'unpaid')
    @push('scripts')
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var payButton = document.getElementById('pay-button');
            if(payButton) {
                payButton.onclick = function(){
                    snap.pay('{{ $reservation->snap_token }}', {
                        onSuccess: function(result){
                            window.location.reload();
                        },
                        onPending: function(result){
                            window.location.reload();
                        },
                        onError: function(result){
                            alert('Pembayaran gagal atau dibatalkan.');
                            window.location.reload();
                        },
                        onClose: function(){
                            // Customer closed the popup without finishing the payment
                        }
                    });
                };
            }
        });
    </script>
    @endpush
@endif
