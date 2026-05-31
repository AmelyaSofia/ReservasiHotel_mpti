<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Buat akun admin default untuk sistem.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@hotel.com'],
            [
                'name'     => 'Admin Hotel',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );
    }
}
