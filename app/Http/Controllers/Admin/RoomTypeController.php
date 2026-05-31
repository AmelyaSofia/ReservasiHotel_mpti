<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomTypeRequest;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomTypeController extends Controller
{
    /**
     * Tampilkan daftar semua tipe kamar.
     */
    public function index(): View
    {
        $roomTypes = RoomType::withCount('rooms')->latest()->paginate(10);

        return view('admin.room-types.index', compact('roomTypes'));
    }

    /**
     * Tampilkan form tambah tipe kamar.
     */
    public function create(): View
    {
        return view('admin.room-types.create');
    }

    /**
     * Simpan tipe kamar baru ke database.
     */
    public function store(RoomTypeRequest $request): RedirectResponse
    {
        RoomType::create($request->validated());

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Tipe kamar berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail satu tipe kamar beserta kamar-kamarnya.
     */
    public function show(RoomType $roomType): View
    {
        $roomType->load('rooms');

        return view('admin.room-types.show', compact('roomType'));
    }

    /**
     * Tampilkan form edit tipe kamar.
     */
    public function edit(RoomType $roomType): View
    {
        return view('admin.room-types.edit', compact('roomType'));
    }

    /**
     * Perbarui data tipe kamar.
     */
    public function update(RoomTypeRequest $request, RoomType $roomType): RedirectResponse
    {
        $roomType->update($request->validated());

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    /**
     * Hapus tipe kamar (hanya jika tidak ada kamar aktif).
     */
    public function destroy(RoomType $roomType): RedirectResponse
    {
        if ($roomType->rooms()->exists()) {
            return back()->with('error', 'Tipe kamar tidak dapat dihapus karena masih memiliki kamar terdaftar.');
        }

        $roomType->delete();

        return redirect()->route('admin.room-types.index')
            ->with('success', 'Tipe kamar berhasil dihapus.');
    }
}
