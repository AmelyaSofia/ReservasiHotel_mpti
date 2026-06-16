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

    /**
     * Satu tipe kamar memiliki banyak harga musiman.
     */
    public function seasonalRates(): HasMany
    {
        return $this->hasMany(SeasonalRate::class);
    }

    /**
     * Dapatkan harga musiman yang aktif untuk hari ini (jika ada).
     */
    public function getActiveSeasonalRateAttribute()
    {
        $today = \Carbon\Carbon::today();
        return $this->seasonalRates()
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();
    }
}
