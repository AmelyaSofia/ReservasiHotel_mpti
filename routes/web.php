<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\FacilityController as AdminFacility;
use App\Http\Controllers\Admin\ReservationController as AdminReservation;
use App\Http\Controllers\Admin\RoomController as AdminRoom;
use App\Http\Controllers\Admin\RoomTypeController as AdminRoomType;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Customer\ReservationController as CustomerReservation;
use App\Http\Controllers\Customer\RoomCatalogController;
use Illuminate\Support\Facades\Route;

// ─── Halaman Utama ─────────────────────────────────────────────────────────────
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('customer.dashboard');
    }
    return redirect()->route('login');
});

// ─── Autentikasi (Tamu) ────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

// Logout (harus login)
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ─── Panel Admin ───────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Tipe Kamar
        Route::resource('room-types', AdminRoomType::class);

        // Kamar
        Route::resource('rooms', AdminRoom::class);

        // Fasilitas
        Route::resource('facilities', AdminFacility::class)->except(['show']);

        // Reservasi
        Route::get('/reservations',                     [AdminReservation::class, 'index'])->name('reservations.index');
        Route::get('/reservations/{reservation}',       [AdminReservation::class, 'show'])->name('reservations.show');
        Route::patch('/reservations/{reservation}/confirm',  [AdminReservation::class, 'confirm'])->name('reservations.confirm');
        Route::patch('/reservations/{reservation}/complete', [AdminReservation::class, 'complete'])->name('reservations.complete');
        Route::patch('/reservations/{reservation}/cancel',   [AdminReservation::class, 'cancel'])->name('reservations.cancel');
        
        // Pelanggan
        Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->except(['show']);
    });

// ─── Area Pelanggan ────────────────────────────────────────────────────────────
Route::middleware(['auth', 'customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('dashboard');

        // Katalog Kamar (publik bagi pelanggan terautentikasi)
        Route::get('/rooms',       [RoomCatalogController::class, 'index'])->name('catalog.index');
        Route::get('/rooms/{room}',[RoomCatalogController::class, 'show'])->name('catalog.show');

        // Reservasi Pelanggan
        Route::get('/reservations',                           [CustomerReservation::class, 'index'])->name('reservations.index');
        Route::get('/reservations/create/{room}',             [CustomerReservation::class, 'create'])->name('reservations.create');
        Route::post('/reservations',                          [CustomerReservation::class, 'store'])->name('reservations.store');
        Route::get('/reservations/{reservation}',             [CustomerReservation::class, 'show'])->name('reservations.show');
        Route::patch('/reservations/{reservation}/cancel',    [CustomerReservation::class, 'cancel'])->name('reservations.cancel');
    });
