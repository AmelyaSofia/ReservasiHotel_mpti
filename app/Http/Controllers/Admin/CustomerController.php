<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Tampilkan daftar pelanggan (user dengan role customer).
     */
    public function index(): View
    {
        $customers = User::where('role', 'customer')
            ->withCount('reservations')
            ->latest()
            ->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    public function create(): View
    {
        return view('admin.customers.create');
    }

    /**
     * Simpan pelanggan baru ke database.
     */
    public function store(\App\Http\Requests\Admin\CustomerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['role'] = 'customer';
        $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit pelanggan.
     */
    public function edit(User $customer): View
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Perbarui data pelanggan.
     */
    public function update(\App\Http\Requests\Admin\CustomerRequest $request, User $customer): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Hapus pelanggan beserta data yang terkait dengannya.
     */
    public function destroy(User $customer): RedirectResponse
    {
        if ($customer->role !== 'customer') {
            return back()->with('error', 'Hanya akun pelanggan yang dapat dihapus.');
        }

        // Cek jika pelanggan memiliki reservasi aktif (pending/confirmed)
        $hasActiveReservations = $customer->reservations()
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($hasActiveReservations) {
            return back()->with('error', 'Tidak dapat menghapus pelanggan yang masih memiliki reservasi aktif.');
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Akun pelanggan berhasil dihapus.');
    }
}
