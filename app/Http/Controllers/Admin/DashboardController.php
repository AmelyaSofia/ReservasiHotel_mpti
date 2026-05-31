<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin dengan ringkasan data.
     */
    public function index(): View
    {
        $stats = [
            'total_kamar'      => Room::count(),
            'kamar_tersedia'   => Room::where('status', 'available')->count(),
            'kamar_terisi'     => Room::where('status', 'occupied')->count(),
            'kamar_maintenance'=> Room::where('status', 'maintenance')->count(),
            'total_reservasi'  => Reservation::count(),
            'reservasi_pending'=> Reservation::where('status', 'pending')->count(),
            'reservasi_confirmed' => Reservation::where('status', 'confirmed')->count(),
            'total_pelanggan'  => User::where('role', 'customer')->count(),
        ];

        // 10 reservasi terbaru
        $reservasiTerbaru = Reservation::with(['user', 'room.roomType'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'reservasiTerbaru'));
    }
}
