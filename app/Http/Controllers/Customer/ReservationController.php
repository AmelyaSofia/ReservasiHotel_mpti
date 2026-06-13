<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ReservationRequest;
use App\Models\Reservation;
use App\Models\Room;
use App\Services\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function __construct(protected ReservationService $reservationService)
    {
    }

    /**
     * Tampilkan riwayat reservasi milik pelanggan yang sedang login.
     */
    public function index(): View
    {
        $reservations = auth()->user()
            ->reservations()
            ->with(['room.roomType'])
            ->latest()
            ->paginate(10);

        return view('customer.reservations.index', compact('reservations'));
    }

    /**
     * Tampilkan form pembuatan reservasi untuk kamar tertentu.
     */
    public function create(Room $room): View
    {
        // Tolak akses jika kamar tidak tersedia
        if ($room->status === 'maintenance') {
            return redirect()->route('customer.catalog.index')
                ->with('error', 'Kamar ini sedang dalam perbaikan.');
        }

        $room->load(['roomType', 'facilities']);

        return view('customer.reservations.create', compact('room'));
    }

    /**
     * Proses pembuatan reservasi baru oleh pelanggan.
     */
    public function store(ReservationRequest $request): RedirectResponse
    {
        $checkIn  = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);

        try {
            $reservation = $this->reservationService->createReservation(
                userId:   auth()->id(),
                roomId:   $request->room_id,
                checkIn:  $checkIn,
                checkOut: $checkOut,
            );

            return redirect()->route('customer.reservations.show', $reservation)
                ->with('success', 'Reservasi berhasil dibuat! Silakan tunggu konfirmasi dari admin.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Tampilkan detail satu reservasi milik pelanggan yang login.
     */
    public function show(Reservation $reservation): View
    {
        // Pastikan reservasi ini milik pelanggan yang sedang login
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke reservasi ini.');
        }

        $reservation->load(['room.roomType', 'room.facilities']);

        return view('customer.reservations.show', compact('reservation'));
    }

    /**
     * Batalkan reservasi oleh pelanggan sendiri.
     * Hanya bisa dilakukan jika status masih pending atau confirmed.
     */
    public function cancel(Reservation $reservation): RedirectResponse
    {
        // Pastikan reservasi ini milik pelanggan yang sedang login
        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke reservasi ini.');
        }

        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Hanya reservasi dengan status pending yang dapat dibatalkan.');
        }

        try {
            $this->reservationService->cancelReservation($reservation);

            return redirect()->route('customer.reservations.index')
                ->with('success', 'Reservasi berhasil dibatalkan.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
