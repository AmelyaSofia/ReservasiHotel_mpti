<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomCatalogController extends Controller
{
    /**
     * Tampilkan katalog kamar yang tersedia untuk pelanggan.
     * Mendukung filter berdasarkan tipe kamar dan rentang harga.
     */
    public function index(Request $request): View
    {
        $query = Room::with(['roomType', 'facilities'])
            ->where('status', 'available');

        // Filter berdasarkan tipe kamar
        if ($request->filled('room_type_id')) {
            $query->where('room_type_id', $request->room_type_id);
        }

        // Filter berdasarkan harga maksimum
        if ($request->filled('max_price')) {
            $query->whereHas('roomType', fn($q) => $q->where('price_per_night', '<=', $request->max_price));
        }

        $rooms     = $query->paginate(12)->withQueryString();
        $roomTypes = RoomType::all();

        return view('customer.catalog.index', compact('rooms', 'roomTypes'));
    }

    /**
     * Tampilkan detail satu kamar beserta fasilitas dan form reservasi.
     */
    public function show(Room $room): View
    {
        // Tolak akses jika kamar dalam perbaikan
        if ($room->status === 'maintenance') {
            abort(404, 'Kamar tidak tersedia saat ini.');
        }

        $room->load(['roomType', 'facilities']);

        return view('customer.catalog.show', compact('room'));
    }
}
