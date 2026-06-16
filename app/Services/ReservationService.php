<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationService
{
    /**
     * Periksa apakah kamar tersedia pada rentang tanggal tertentu.
     * Menangani logika overlap tanggal sepenuhnya di layer ini.
     *
     * Overlap terjadi jika:
     *   check_in_existing < check_out_baru  AND  check_out_existing > check_in_baru
     *
     * @param int         $roomId
     * @param Carbon      $checkIn
     * @param Carbon      $checkOut
     * @param int|null    $excludeReservationId  ID reservasi yang dikecualikan (untuk edit)
     */
    public function isRoomAvailable(
        int $roomId,
        Carbon $checkIn,
        Carbon $checkOut,
        ?int $excludeReservationId = null
    ): bool {
        $query = Reservation::where('room_id', $roomId)
            ->whereNotIn('status', ['cancelled'])
            ->where('check_in_date', '<', $checkOut)
            ->where('check_out_date', '>', $checkIn);

        if ($excludeReservationId) {
            $query->where('id', '!=', $excludeReservationId);
        }

        return $query->doesntExist();
    }

    /**
     * Hitung total harga reservasi berdasarkan durasi dan harga per malam tipe kamar.
     * Termasuk pengecekan Harga Dinamis / Musiman (Seasonal Rates).
     */
    public function calculateTotalPrice(Room $room, Carbon $checkIn, Carbon $checkOut): float
    {
        $totalPrice = 0;
        $currentDate = $checkIn->copy();
        
        $roomType = $room->roomType;
        // Ambil semua harga musiman untuk tipe kamar ini
        $seasonalRates = $roomType->seasonalRates;

        $nights = $checkIn->diffInDays($checkOut);

        for ($i = 0; $i < $nights; $i++) {
            $nightPrice = $roomType->price_per_night;

            // Cek apakah ada harga khusus (seasonal rate) untuk tanggal ini
            foreach ($seasonalRates as $rate) {
                if ($currentDate->gte($rate->start_date) && $currentDate->lte($rate->end_date)) {
                    $nightPrice = $rate->price_per_night;
                    break; // Gunakan harga musiman pertama yang cocok
                }
            }

            $totalPrice += $nightPrice;
            $currentDate->addDay();
        }

        return $totalPrice;
    }

    /**
     * Buat reservasi baru dengan validasi ketersediaan kamar.
     * Menggunakan DB::transaction untuk konsistensi data.
     *
     * @throws \Exception
     */
    public function createReservation(
        int $userId,
        int $roomId,
        Carbon $checkIn,
        Carbon $checkOut
    ): Reservation {
        $room = Room::with('roomType')->findOrFail($roomId);

        // Validasi status kamar
        if ($room->status === 'maintenance') {
            throw new \Exception('Kamar sedang dalam perbaikan dan tidak dapat dipesan.');
        }

        // Validasi ketersediaan tanggal
        if (!$this->isRoomAvailable($roomId, $checkIn, $checkOut)) {
            throw new \Exception('Kamar tidak tersedia pada tanggal yang dipilih.');
        }

        $totalPrice = $this->calculateTotalPrice($room, $checkIn, $checkOut);

        return DB::transaction(function () use ($userId, $roomId, $checkIn, $checkOut, $totalPrice, $room) {
            $reservation = Reservation::create([
                'user_id'        => $userId,
                'room_id'        => $roomId,
                'check_in_date'  => $checkIn,
                'check_out_date' => $checkOut,
                'total_price'    => $totalPrice,
                'status'         => 'pending',
            ]);

            // Perbarui status kamar menjadi occupied
            $room->update(['status' => 'occupied']);

            return $reservation;
        });
    }

    /**
     * Konfirmasi reservasi (ubah status dari pending → confirmed).
     * Hanya bisa dilakukan oleh admin.
     *
     * @throws \Exception
     */
    public function confirmReservation(Reservation $reservation): Reservation
    {
        if ($reservation->status !== 'pending') {
            throw new \Exception('Hanya reservasi dengan status pending yang dapat dikonfirmasi.');
        }

        DB::transaction(function () use ($reservation) {
            $reservation->update(['status' => 'confirmed']);
        });

        return $reservation->fresh();
    }

    /**
     * Selesaikan reservasi (ubah status dari confirmed → completed).
     *
     * @throws \Exception
     */
    public function completeReservation(Reservation $reservation): Reservation
    {
        if ($reservation->status !== 'confirmed') {
            throw new \Exception('Hanya reservasi yang sudah dikonfirmasi yang dapat diselesaikan.');
        }

        DB::transaction(function () use ($reservation) {
            $reservation->update(['status' => 'completed']);

            // Bebaskan kamar kembali ke available
            $reservation->room->update(['status' => 'available']);
        });

        return $reservation->fresh();
    }

    /**
     * Batalkan reservasi (pending/confirmed → cancelled).
     * Memulihkan status kamar ke available.
     *
     * @throws \Exception
     */
    public function cancelReservation(Reservation $reservation): Reservation
    {
        if (!$reservation->isCancellable()) {
            throw new \Exception('Reservasi dengan status ' . $reservation->status . ' tidak dapat dibatalkan.');
        }

        DB::transaction(function () use ($reservation) {
            $reservation->update(['status' => 'cancelled']);

            // Pulihkan ketersediaan kamar
            $reservation->room->update(['status' => 'available']);
        });

        return $reservation->fresh();
    }
}
