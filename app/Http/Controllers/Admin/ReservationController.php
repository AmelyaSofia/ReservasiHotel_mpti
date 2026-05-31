<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function __construct(protected ReservationService $reservationService)
    {
    }

    /**
     * Tampilkan daftar semua reservasi dengan filter status.
     */
    public function index(Request $request): View
    {
        $query = Reservation::with(['user', 'room.roomType'])->latest();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pencarian berdasarkan nama/email pelanggan atau nomor kamar
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%"))
                  ->orWhereHas('room', fn($r) => $r->where('room_number', 'like', "%{$search}%"));
            });
        }

        $reservations = $query->paginate(15)->withQueryString();

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Tampilkan detail satu reservasi.
     */
    public function show(Reservation $reservation): View
    {
        $reservation->load(['user', 'room.roomType', 'room.facilities']);

        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Konfirmasi reservasi: pending → confirmed.
     */
    public function confirm(Reservation $reservation): RedirectResponse
    {
        try {
            $this->reservationService->confirmReservation($reservation);

            return redirect()->route('admin.reservations.show', $reservation)
                ->with('success', 'Reservasi berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Selesaikan reservasi: confirmed → completed.
     */
    public function complete(Reservation $reservation): RedirectResponse
    {
        try {
            $this->reservationService->completeReservation($reservation);

            return redirect()->route('admin.reservations.show', $reservation)
                ->with('success', 'Reservasi telah diselesaikan dan kamar kembali tersedia.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Batalkan reservasi oleh admin.
     */
    public function cancel(Reservation $reservation): RedirectResponse
    {
        try {
            $this->reservationService->cancelReservation($reservation);

            return redirect()->route('admin.reservations.show', $reservation)
                ->with('success', 'Reservasi berhasil dibatalkan dan kamar kembali tersedia.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
