<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard pelanggan dengan ringkasan reservasi.
     */
    public function index(): View
    {
        $user = auth()->user();

        $stats = [
            'total'     => $user->reservations()->count(),
            'pending'   => $user->reservations()->where('status', 'pending')->count(),
            'confirmed' => $user->reservations()->where('status', 'confirmed')->count(),
            'completed' => $user->reservations()->where('status', 'completed')->count(),
            'cancelled' => $user->reservations()->where('status', 'cancelled')->count(),
        ];

        // 5 reservasi terbaru milik pelanggan ini
        $reservasiTerbaru = $user->reservations()
            ->with(['room.roomType'])
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('stats', 'reservasiTerbaru'));
    }
}
