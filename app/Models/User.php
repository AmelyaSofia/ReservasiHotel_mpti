<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan dari serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ─── Helpers ───────────────────────────────────────────────────────────

    /**
     * Cek apakah pengguna adalah admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah pengguna adalah pelanggan.
     */
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    // ─── Relasi ────────────────────────────────────────────────────────────

    /**
     * Satu pengguna memiliki banyak reservasi.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
