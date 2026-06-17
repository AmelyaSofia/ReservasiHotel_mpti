@extends('layouts.admin')

@section('title', 'Ubah Data Kamar')
@section('page_title', 'Kelola Kamar')
@section('breadcrumb', 'Ubah rincian unit kamar dan fasilitas terpasang')

@section('content')

{{-- ════════════════════════ PAGE HEADER ════ --}}
<div class="mb-8">
    <div class="flex items-center gap-2 mb-2">
        <a href="{{ route('admin.rooms.index') }}" class="text-xs text-[#8C7B65] hover:text-[#2A1D14] tracking-widest uppercase transition-colors">
            Kamar
        </a>
        <span class="text-xs text-[#A89880]">&gt;</span>
        <span class="text-xs text-[#B8935A] tracking-widest uppercase">Ubah Kamar</span>
    </div>
    <h2 class="text-2xl font-light text-[#2A1D14]" style="font-family: 'Cormorant Garamond', serif; letter-spacing: 0.02em;">
        Ubah Kamar {{ $room->room_number }}
    </h2>
    <div class="gold-line mt-3"></div>
</div>

{{-- ════════════════════════ FORM CONTAINER ════ --}}
<form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- LEFT COLUMN: FORM INPUTS --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="card-luxury p-6 sm:p-8 space-y-6">
                <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 mb-4 font-semibold">
                    Informasi Utama Kamar
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Nomor Kamar --}}
                    <div>
                        <label for="room_number" class="form-label">Nomor Kamar <span class="text-red-700">*</span></label>
                        <input type="text" name="room_number" id="room_number" value="{{ old('room_number', $room->room_number) }}" 
                               class="form-input-box @error('room_number') border-red-500 @enderror" 
                               placeholder="Contoh: 101, 204" required>
                        @error('room_number')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tipe Kamar --}}
                    <div>
                        <label for="room_type_id" class="form-label">Tipe Kamar <span class="text-red-700">*</span></label>
                        <select name="room_type_id" id="room_type_id" class="form-input-box @error('room_type_id') border-red-500 @enderror" required>
                            <option value="" disabled>-- Pilih Tipe Kamar --</option>
                            @foreach($roomTypes as $type)
                                <option value="{{ $type->id }}" {{ old('room_type_id', $room->room_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }} (Rp {{ number_format($type->price_per_night, 0, ',', '.') }}/malam)
                                </option>
                            @endforeach
                        </select>
                        @error('room_type_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kapasitas --}}
                    <div>
                        <label for="capacity" class="form-label">Kapasitas Maksimal <span class="text-red-700">*</span></label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $room->capacity) }}" min="1"
                               class="form-input-box @error('capacity') border-red-500 @enderror" required>
                        @error('capacity')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="form-label">Status Kamar <span class="text-red-700">*</span></label>
                        <select name="status" id="status" class="form-input-box @error('status') border-red-500 @enderror" required>
                            <option value="available" {{ old('status', $room->status) === 'available' ? 'selected' : '' }}>Tersedia (Available)</option>
                            <option value="maintenance" {{ old('status', $room->status) === 'maintenance' ? 'selected' : '' }}>Perbaikan (Maintenance)</option>
                            <option value="occupied" {{ old('status', $room->status) === 'occupied' ? 'selected' : '' }}>Terisi (Occupied)</option>
                        </select>
                        @error('status')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi Kamar --}}
                <div>
                    <label for="description" class="form-label">Deskripsi Kamar <span class="text-red-700">*</span></label>
                    <textarea name="description" id="description" rows="5" 
                              class="form-input-box @error('description') border-red-500 @enderror" 
                              placeholder="Tuliskan deskripsi lengkap kamar di sini..." required>{{ old('description', $room->description) }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Checklist Fasilitas Kamar --}}
            <div class="card-luxury p-6 sm:p-8">
                <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 mb-5 font-semibold">
                    Fasilitas Kamar
                </p>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($facilities as $facility)
                        <label class="flex items-center gap-3 cursor-pointer py-1.5 hover:text-[#2A1D14] transition-colors group">
                            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                   {{ is_array(old('facilities', $room->facilities->pluck('id')->toArray())) && in_array($facility->id, old('facilities', $room->facilities->pluck('id')->toArray())) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded-none border-[#DDD5C5] text-[#B8935A] focus:ring-[#B8935A] focus:ring-opacity-25 accent-[#B8935A]">
                            <span class="text-sm text-[#5C4033] group-hover:text-[#2A1D14] transition-colors">{{ $facility->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('facilities')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- RIGHT COLUMN: IMAGE UPLOAD & ACTION BUTTONS --}}
        <div class="space-y-6">
            {{-- Panel Foto --}}
            <div class="card-luxury p-6 space-y-5">
                <p class="text-xs text-[#B8935A] tracking-widest uppercase border-b border-[#EDE8DC] pb-3 font-semibold">
                    Foto Utama Kamar
                </p>

                {{-- Preview Container --}}
                <div id="imagePreviewContainer" class="relative w-full aspect-video sm:aspect-square lg:aspect-[4/3] bg-[#F7F4EE] border border-[#DDD5C5] overflow-hidden flex flex-col items-center justify-center p-4">
                    @if($room->image)
                        <img id="imagePreview" src="{{ asset('storage/' . $room->image) }}" alt="Foto Kamar" class="absolute inset-0 w-full h-full object-cover">
                        <div id="imagePlaceholder" class="text-center flex flex-col items-center gap-3 hidden">
                            <svg class="w-10 h-10 text-[#A89880]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                            </svg>
                            <p class="text-xs text-[#A89880] tracking-wider uppercase font-semibold">Belum Ada Gambar</p>
                        </div>
                    @else
                        <img id="imagePreview" src="#" alt="Preview Foto Kamar" class="absolute inset-0 w-full h-full object-cover hidden">
                        <div id="imagePlaceholder" class="text-center flex flex-col items-center gap-3">
                            <svg class="w-10 h-10 text-[#A89880]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                            </svg>
                            <p class="text-xs text-[#A89880] tracking-wider uppercase font-semibold">Belum Ada Gambar</p>
                        </div>
                    @endif
                </div>

                {{-- File Input --}}
                <div>
                    <label for="image" class="form-label">Ganti Berkas Foto (Opsional)</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full text-xs text-[#8C7B65] 
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-none file:border-0
                                  file:text-xs file:font-semibold file:uppercase file:tracking-wider
                                  file:bg-[#EDE8DC] file:text-[#5C4033]
                                  hover:file:bg-[#DDD5C5] transition-colors"
                           onchange="previewFile()">
                    <p class="mt-2 text-[10px] text-[#A89880]">Format: JPEG, PNG, JPG, Webp. Maksimal 5MB.</p>
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Panel Aksi --}}
            <div class="card-luxury p-6 space-y-4">
                <button type="submit" class="w-full btn-primary py-3 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Perbarui Kamar
                </button>
                <a href="{{ route('admin.rooms.index') }}" class="w-full btn-outline py-3 flex items-center justify-center gap-2">
                    Batal
                </a>
            </div>
        </div>
        
    </div>
</form>

{{-- Live image preview script --}}
<script>
function previewFile() {
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('imagePlaceholder');
    const file = document.getElementById('image').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
        preview.classList.remove('hidden');
        if (placeholder) placeholder.classList.add('hidden');
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>

@endsection
