<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomRequest;
use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * Tampilkan daftar semua kamar dengan filter.
     */
    public function index(): View
    {
        $rooms = Room::with(['roomType', 'facilities'])
            ->latest()
            ->paginate(12);

        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Tampilkan form tambah kamar.
     */
    public function create(): View
    {
        $roomTypes  = RoomType::all();
        $facilities = Facility::all();

        return view('admin.rooms.create', compact('roomTypes', 'facilities'));
    }

    /**
     * Simpan kamar baru ke database.
     */
    public function store(RoomRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        } else {
            $data['image'] = null;
        }

        $room = Room::create($data);

        // Simpan relasi fasilitas
        if (!empty($data['facilities'])) {
            $room->facilities()->sync($data['facilities']);
        }

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar ' . $room->room_number . ' berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail satu kamar.
     */
    public function show(Room $room): View
    {
        $room->load(['roomType', 'facilities', 'reservations.user']);

        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Tampilkan form edit kamar.
     */
    public function edit(Room $room): View
    {
        $roomTypes  = RoomType::all();
        $facilities = Facility::all();
        $room->load('facilities');

        return view('admin.rooms.edit', compact('room', 'roomTypes', 'facilities'));
    }

    /**
     * Perbarui data kamar.
     */
    public function update(RoomRequest $request, Room $room): RedirectResponse
    {
        $data = $request->validated();

        // Proses upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $data['image'] = $request->file('image')->store('rooms', 'public');
        } else {
            // Tetap gunakan gambar lama
            unset($data['image']);
        }

        $room->update($data);

        // Perbarui relasi fasilitas
        $room->facilities()->sync($data['facilities'] ?? []);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar ' . $room->room_number . ' berhasil diperbarui.');
    }

    /**
     * Hapus kamar (soft delete). Kamar yang memiliki reservasi aktif tidak boleh dihapus.
     */
    public function destroy(Room $room): RedirectResponse
    {
        $reservasiAktif = $room->reservations()
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($reservasiAktif) {
            return back()->with('error', 'Kamar tidak dapat dihapus karena memiliki reservasi aktif.');
        }

        // Hapus gambar dari storage
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar ' . $room->room_number . ' berhasil dihapus.');
    }
}
