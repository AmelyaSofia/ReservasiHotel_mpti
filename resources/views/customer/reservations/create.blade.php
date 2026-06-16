@extends('layouts.customer')

@section('title', 'Buat Reservasi')

@section('content')

{{-- ════════════════════════ BREADCRUMBS & HEADER ════ --}}
<div class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('customer.dashboard') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Beranda
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <a href="{{ route('customer.catalog.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Kamar
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Reservasi</span>
    </div>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Pemesanan Kamar
    </h2>
    <div class="gold-line mt-3"></div>
</div>

{{-- ════════════════════════ RESERVATION GRID ════ --}}
@php
    $seasonalRates = $room->roomType->seasonalRates()->where('end_date', '>=', now()->startOfDay())->get();
    $activeRate = $room->roomType->active_seasonal_rate;
    $currentPrice = $activeRate ? $activeRate->price_per_night : $room->roomType->price_per_night;
@endphp
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- LEFT COLUMN: RESERVATION FORM (2/3 width) --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="card-luxury p-6 sm:p-8 bg-white space-y-6">
            <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 mb-4 font-semibold">
                Formulir Reservasi
            </p>

            @if($seasonalRates->count() > 0)
                <div class="bg-[#FDFCF8] border border-[#F7EAC7] p-4 space-y-2 mb-6">
                    <div class="flex items-center gap-2 text-[#8C2323] font-semibold text-[10px] tracking-widest uppercase">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Informasi Promo & Harga Spesial
                    </div>
                    <p class="text-xs text-[#8C7B65]">Tipe kamar ini memiliki penyesuaian harga khusus pada periode berikut:</p>
                    <ul class="list-disc list-inside text-xs text-[#5C4033] space-y-1 ml-1 mt-2">
                        @foreach($seasonalRates as $rate)
                            <li>
                                <strong>{{ $rate->description ?: 'Harga Musiman' }}</strong>: 
                                Rp {{ number_format($rate->price_per_night, 0, ',', '.') }} / malam 
                                <span class="text-[#A89880]">({{ $rate->start_date->format('d M Y') }} &mdash; {{ $rate->end_date->format('d M Y') }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.reservations.store') }}" method="POST" id="reservationForm">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    {{-- Check-in Date --}}
                    <div>
                        <label for="check_in_date" class="form-label">Tanggal Check-in <span class="text-red-700">*</span></label>
                        <input type="date" name="check_in_date" id="check_in_date" 
                               value="{{ old('check_in_date', date('Y-m-d')) }}" 
                               min="{{ date('Y-m-d') }}"
                               class="form-input-box @error('check_in_date') border-red-500 @enderror" 
                               required onchange="calculatePrice()">
                        @error('check_in_date')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Check-out Date --}}
                    <div>
                        <label for="check_out_date" class="form-label">Tanggal Check-out <span class="text-red-700">*</span></label>
                        <input type="date" name="check_out_date" id="check_out_date" 
                               value="{{ old('check_out_date', date('Y-m-d', strtotime('+1 day'))) }}" 
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="form-input-box @error('check_out_date') border-red-500 @enderror" 
                               required onchange="calculatePrice()">
                        @error('check_out_date')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Dinamic Calculation Summary Panel --}}
                <div id="calculationPanel" class="bg-[#F7F4EE] border border-[#DDD5C5] p-5 mb-6 space-y-3">
                    <p class="text-[10px] text-[#B8935A] tracking-widest uppercase font-semibold">Estimasi Pemesanan</p>
                    <div class="flex justify-between items-center text-xs text-[#8C7B65]">
                        <span>Durasi Menginap:</span>
                        <span id="stayNights" class="font-bold text-[#2A1D14]">1 Malam</span>
                    </div>
                    <div class="flex justify-between items-center text-xs text-[#8C7B65]">
                        <span>Harga Kamar:</span>
                        <div class="text-right">
                            <span class="font-bold text-[#2A1D14]">Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }} / malam</span>
                        </div>
                    </div>
                    <div class="h-px bg-[#DDD5C5] my-2"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-semibold text-[#5C4033]">Total Biaya:</span>
                        <span id="totalCost" class="text-lg font-bold text-[#B8935A]">Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}</span>
                    </div>
                    <p id="dateWarning" class="text-xs text-red-700 hidden mt-2"></p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-4 border-t border-[#EDE8DC] pt-6">
                    <button type="submit" id="submitBtn" class="flex-1 btn-primary py-3.5 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Konfirmasi Pemesanan
                    </button>
                    <a href="{{ route('customer.catalog.show', $room) }}" class="btn-outline py-3.5 px-6 flex items-center justify-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- RIGHT COLUMN: SUITE SUMMARY (1/3 width) --}}
    <div class="space-y-6">
        <div class="card-luxury overflow-hidden bg-white">
            <div class="w-full aspect-[4/3] bg-[#EDE8DC]">
                @if($room->image)
                    <img src="{{ asset('storage/' . $room->image) }}" alt="Kamar {{ $room->room_number }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-[#8C7B65] p-4 text-center">
                        <svg class="w-10 h-10 opacity-30 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1.091m-18.75 0l3-1.091m0 0V9m0 0L9 5.454m9 1.636V9m-9-3.545L20.25 9m-11-3.545V21"/>
                        </svg>
                        <span class="text-[10px] tracking-widest uppercase font-semibold text-[#A89880]">Foto Kamar</span>
                    </div>
                @endif
            </div>
            
            <div class="p-5 space-y-4">
                <div>
                    <p class="text-[10px] text-[#B8935A] tracking-[0.2em] uppercase font-semibold">{{ $room->roomType->name }}</p>
                    <h3 class="text-xl font-light text-[#2A1D14] mt-0.5" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
                        Suite {{ $room->room_number }}
                    </h3>
                </div>

                <div class="border-t border-[#F7F4EE] pt-3.5 space-y-2.5">
                    <div class="flex justify-between text-xs text-[#8C7B65]">
                        <span>Kapasitas:</span>
                        <span class="font-bold text-[#2A1D14]">{{ $room->capacity }} Tamu</span>
                    </div>
                    <div class="flex justify-between text-xs text-[#8C7B65]">
                        <span>Tarif per malam:</span>
                        <div class="text-right">
                            @if($activeRate)
                                <p class="text-[9px] text-[#A89880] line-through mb-0.5">Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}</p>
                                <p class="font-bold text-[#8C2323] flex items-center gap-1 justify-end">
                                    <span class="bg-[#8C2323] text-white text-[8px] px-1 py-0.5 rounded uppercase tracking-wider font-sans font-normal">Promo</span>
                                    Rp {{ number_format($currentPrice, 0, ',', '.') }}
                                </p>
                            @else
                                <span class="font-bold text-[#B8935A]">Rp {{ number_format($room->roomType->price_per_night, 0, ',', '.') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="border-t border-[#F7F4EE] pt-3.5">
                    <p class="text-[10px] text-[#B8935A] tracking-wider uppercase font-semibold mb-2">Fasilitas Utama</p>
                    <div class="flex flex-wrap gap-1">
                        @foreach($room->facilities->take(4) as $fac)
                            <span class="text-[9px] bg-[#F7F4EE] border border-[#EDE8DC] text-[#705F4A] px-2 py-0.5 tracking-wide">
                                {{ $fac->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- ════════════════════════ CALCULATOR SCRIPT ════ --}}
<script>
const basePrice = {{ $room->roomType->price_per_night }};
const seasonalRates = @json($seasonalRates->map(function($rate) {
    return [
        'start' => $rate->start_date->format('Y-m-d'),
        'end' => $rate->end_date->format('Y-m-d'),
        'price' => (int) $rate->price_per_night
    ];
}));

function calculatePrice() {
    const inVal = document.getElementById('check_in_date').value;
    const outVal = document.getElementById('check_out_date').value;
    const stayNightsText = document.getElementById('stayNights');
    const totalCostText = document.getElementById('totalCost');
    const dateWarning = document.getElementById('dateWarning');
    const submitBtn = document.getElementById('submitBtn');

    if (!inVal || !outVal) {
        return;
    }

    const checkIn = new Date(inVal);
    const checkOut = new Date(outVal);
    
    // Reset time for accurate date difference
    checkIn.setHours(0,0,0,0);
    checkOut.setHours(0,0,0,0);

    const timeDiff = checkOut.getTime() - checkIn.getTime();
    const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

    if (daysDiff <= 0) {
        // Date conflict
        dateWarning.innerText = "Tanggal check-out harus setelah tanggal check-in.";
        dateWarning.classList.remove('hidden');
        stayNightsText.innerText = "-";
        totalCostText.innerText = "Rp 0";
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        // Correct dates
        dateWarning.classList.add('hidden');
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        
        let totalCost = 0;
        let currentDate = new Date(checkIn);
        
        for (let i = 0; i < daysDiff; i++) {
            let dayPrice = basePrice;
            
            // Check if current day falls into any seasonal rate
            for (let rate of seasonalRates) {
                let rs = new Date(rate.start); rs.setHours(0,0,0,0);
                let re = new Date(rate.end); re.setHours(0,0,0,0);
                if (currentDate >= rs && currentDate <= re) {
                    dayPrice = rate.price;
                    break;
                }
            }
            totalCost += dayPrice;
            
            // Move to next day
            currentDate.setDate(currentDate.getDate() + 1);
        }
        
        stayNightsText.innerText = daysDiff + " Malam";
        totalCostText.innerText = "Rp " + totalCost.toLocaleString('id-ID');
    }
}

// Trigger initial calculation
calculatePrice();
</script>

@endsection
