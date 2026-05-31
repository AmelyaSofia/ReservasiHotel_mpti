<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FacilityRequest;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FacilityController extends Controller
{
    /**
     * Tampilkan daftar semua fasilitas.
     */
    public function index(): View
    {
        $facilities = Facility::withCount('rooms')->latest()->paginate(15);

        return view('admin.facilities.index', compact('facilities'));
    }

    /**
     * Tampilkan form tambah fasilitas.
     */
    public function create(): View
    {
        return view('admin.facilities.create');
    }

    /**
     * Simpan fasilitas baru ke database.
     */
    public function store(FacilityRequest $request): RedirectResponse
    {
        Facility::create($request->validated());

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit fasilitas.
     */
    public function edit(Facility $facility): View
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    /**
     * Perbarui data fasilitas.
     */
    public function update(FacilityRequest $request, Facility $facility): RedirectResponse
    {
        $facility->update($request->validated());

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Hapus fasilitas (hanya jika tidak digunakan kamar manapun).
     */
    public function destroy(Facility $facility): RedirectResponse
    {
        if ($facility->rooms()->exists()) {
            return back()->with('error', 'Fasilitas tidak dapat dihapus karena masih digunakan oleh kamar.');
        }

        $facility->delete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}
