<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
    ];

    // ─── Relasi ────────────────────────────────────────────────────────────

    /**
     * Fasilitas dimiliki oleh banyak kamar (Many-to-Many).
     */
    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'facility_room');
    }
}
