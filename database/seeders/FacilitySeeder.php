<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Isi master data fasilitas hotel.
     */
    public function run(): void
    {
        $facilities = [
            'WiFi',
            'AC (Air Conditioner)',
            'TV LED',
            'Kulkas Mini',
            'Brankas Kamar',
            'Kamar Mandi Dalam',
            'Air Panas',
            'Balkon',
            'Bathtub',
            'Meja Kerja',
        ];

        foreach ($facilities as $name) {
            Facility::firstOrCreate(['name' => $name]);
        }
    }
}
