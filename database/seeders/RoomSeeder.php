<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Isi master data tipe kamar dan kamar hotel.
     */
    public function run(): void
    {
        // ── Tipe Kamar ───────────────────────────────────────────────────────
        $tipeKamar = [
            [
                'name'            => 'Standar',
                'description'     => 'Kamar standar yang nyaman dengan fasilitas dasar lengkap. Cocok untuk perjalanan bisnis atau wisata hemat.',
                'price_per_night' => 350000,
            ],
            [
                'name'            => 'Deluxe',
                'description'     => 'Kamar deluxe dengan dekorasi elegan dan fasilitas lebih lengkap. Memberikan pengalaman menginap yang menyenangkan.',
                'price_per_night' => 550000,
            ],
            [
                'name'            => 'Suite',
                'description'     => 'Kamar suite mewah dengan ruang tamu terpisah, bathtub, dan pemandangan kota yang menakjubkan.',
                'price_per_night' => 1200000,
            ],
            [
                'name'            => 'Family Room',
                'description'     => 'Kamar keluarga luas yang dirancang untuk kenyamanan seluruh keluarga dengan kapasitas hingga 4 orang.',
                'price_per_night' => 800000,
            ],
        ];

        foreach ($tipeKamar as $tipe) {
            RoomType::firstOrCreate(['name' => $tipe['name']], $tipe);
        }

        // ── Data Kamar ───────────────────────────────────────────────────────
        $standar    = RoomType::where('name', 'Standar')->first();
        $deluxe     = RoomType::where('name', 'Deluxe')->first();
        $suite      = RoomType::where('name', 'Suite')->first();
        $familyRoom = RoomType::where('name', 'Family Room')->first();

        $kamarData = [
            // Standar
            ['room_number' => '101', 'room_type_id' => $standar->id,    'capacity' => 2, 'status' => 'available', 'description' => 'Kamar standar lantai 1 dengan pemandangan taman.', 'image' => 'rooms/standar.png'],
            ['room_number' => '102', 'room_type_id' => $standar->id,    'capacity' => 2, 'status' => 'available', 'description' => 'Kamar standar lantai 1 dekat kolam renang.', 'image' => 'rooms/standar.png'],
            ['room_number' => '103', 'room_type_id' => $standar->id,    'capacity' => 2, 'status' => 'available', 'description' => 'Kamar standar lantai 1 sudut barat.', 'image' => 'rooms/standar.png'],
            // Deluxe
            ['room_number' => '201', 'room_type_id' => $deluxe->id,     'capacity' => 2, 'status' => 'available', 'description' => 'Kamar deluxe lantai 2 dengan pemandangan kota.', 'image' => 'rooms/deluxe.png'],
            ['room_number' => '202', 'room_type_id' => $deluxe->id,     'capacity' => 2, 'status' => 'available', 'description' => 'Kamar deluxe lantai 2 dengan balkon.', 'image' => 'rooms/deluxe.png'],
            ['room_number' => '203', 'room_type_id' => $deluxe->id,     'capacity' => 2, 'status' => 'available', 'description' => 'Kamar deluxe lantai 2 king bed.', 'image' => 'rooms/deluxe.png'],
            // Suite
            ['room_number' => '301', 'room_type_id' => $suite->id,      'capacity' => 2, 'status' => 'available', 'description' => 'Suite eksklusif lantai 3 dengan panorama kota malam.', 'image' => 'rooms/suite.png'],
            ['room_number' => '302', 'room_type_id' => $suite->id,      'capacity' => 2, 'status' => 'available', 'description' => 'Suite premium lantai 3 dengan jacuzzi.', 'image' => 'rooms/suite.png'],
            // Family Room
            ['room_number' => '401', 'room_type_id' => $familyRoom->id, 'capacity' => 4, 'status' => 'available', 'description' => 'Kamar keluarga luas lantai 4 dengan 2 kamar tidur.', 'image' => 'rooms/family.png'],
            ['room_number' => '402', 'room_type_id' => $familyRoom->id, 'capacity' => 4, 'status' => 'available', 'description' => 'Kamar keluarga lantai 4 dekat area bermain.', 'image' => 'rooms/family.png'],
        ];

        foreach ($kamarData as $data) {
            Room::updateOrCreate(['room_number' => $data['room_number']], $data);
        }

        // ── Relasi Fasilitas ─────────────────────────────────────────────────
        $wifi    = Facility::where('name', 'WiFi')->first();
        $ac      = Facility::where('name', 'AC (Air Conditioner)')->first();
        $tv      = Facility::where('name', 'TV LED')->first();
        $kulkas  = Facility::where('name', 'Kulkas Mini')->first();
        $kamar   = Facility::where('name', 'Kamar Mandi Dalam')->first();
        $airPanas= Facility::where('name', 'Air Panas')->first();
        $balkon  = Facility::where('name', 'Balkon')->first();
        $bathtub = Facility::where('name', 'Bathtub')->first();
        $meja    = Facility::where('name', 'Meja Kerja')->first();
        $brankas = Facility::where('name', 'Brankas Kamar')->first();

        // Fasilitas per tipe kamar
        $fasilitasStandar = [$wifi, $ac, $tv, $kamar, $airPanas];
        $fasilitasDeluxe  = [$wifi, $ac, $tv, $kulkas, $kamar, $airPanas, $balkon, $meja, $brankas];
        $fasilitasSuite   = [$wifi, $ac, $tv, $kulkas, $kamar, $airPanas, $balkon, $bathtub, $meja, $brankas];
        $fasilitasFamily  = [$wifi, $ac, $tv, $kulkas, $kamar, $airPanas, $brankas];

        $this->syncFasilitas('101', array_filter($fasilitasStandar));
        $this->syncFasilitas('102', array_filter($fasilitasStandar));
        $this->syncFasilitas('103', array_filter($fasilitasStandar));
        $this->syncFasilitas('201', array_filter($fasilitasDeluxe));
        $this->syncFasilitas('202', array_filter($fasilitasDeluxe));
        $this->syncFasilitas('203', array_filter($fasilitasDeluxe));
        $this->syncFasilitas('301', array_filter($fasilitasSuite));
        $this->syncFasilitas('302', array_filter($fasilitasSuite));
        $this->syncFasilitas('401', array_filter($fasilitasFamily));
        $this->syncFasilitas('402', array_filter($fasilitasFamily));
    }

    /**
     * Sinkronisasi fasilitas ke kamar berdasarkan nomor kamar.
     */
    private function syncFasilitas(string $roomNumber, array $facilities): void
    {
        $room = Room::where('room_number', $roomNumber)->first();
        if ($room) {
            $ids = collect($facilities)->pluck('id')->filter()->toArray();
            $room->facilities()->sync($ids);
        }
    }
}
