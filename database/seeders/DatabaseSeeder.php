<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan semua seeder secara berurutan.
     * Urutan penting: Admin → Facility → Room (karena Room depends on Facility untuk pivot).
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            FacilitySeeder::class,
            RoomSeeder::class,
        ]);
    }
}
