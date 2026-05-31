<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'room_number',
        'room_type_id',
        'capacity',
        'status',
        'description',
        'image',
    ];

    /**
     * Casting atribut.
     */
    protected $casts = [
        'capacity' => 'integer',
    ];

    // ─── Relasi ────────────────────────────────────────────────────────────

    /**
     * Kamar milik satu tipe kamar.
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    /**
     * Kamar memiliki banyak fasilitas (Many-to-Many).
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'facility_room');
    }

    /**
     * Kamar memiliki banyak reservasi.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // ─── Scope ─────────────────────────────────────────────────────────────

    /**
     * Scope untuk kamar yang tersedia.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}
