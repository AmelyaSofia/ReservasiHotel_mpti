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

    /**
     * Hapus pelanggan beserta data yang terkait dengannya.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->role !== 'customer') {
            return back()->with('error', 'Hanya akun pelanggan yang dapat dihapus.');
        }

        // Cek jika pelanggan memiliki reservasi aktif (pending/confirmed)
        $hasActiveReservations = $user->reservations()
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($hasActiveReservations) {
            return back()->with('error', 'Tidak dapat menghapus pelanggan yang masih memiliki reservasi aktif.');
        }

        $user->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Akun pelanggan berhasil dihapus.');
    }
}
