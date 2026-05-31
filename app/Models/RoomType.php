<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'description',
        'price_per_night',
    ];

    /**
     * Casting atribut.
     */
    protected $casts = [
        'price_per_night' => 'decimal:2',
    ];

    // ─── Relasi ────────────────────────────────────────────────────────────

    /**
     * Satu tipe kamar memiliki banyak kamar.
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}
