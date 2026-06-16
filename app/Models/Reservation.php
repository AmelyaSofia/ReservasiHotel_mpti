<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'total_price',
        'status',
        'snap_token',
        'payment_status',
    ];

    /**
     * Casting atribut.
     */
    protected $casts = [
        'check_in_date'  => 'date',
        'check_out_date' => 'date',
        'total_price'    => 'decimal:2',
    ];

    // ─── Relasi ────────────────────────────────────────────────────────────

    /**
     * Reservasi milik satu pengguna (pelanggan).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Reservasi milik satu kamar.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    // ─── Helpers ───────────────────────────────────────────────────────────

    /**
     * Hitung jumlah malam menginap.
     */
    public function getNightsAttribute(): int
    {
        return $this->check_in_date->diffInDays($this->check_out_date);
    }

    /**
     * Cek apakah reservasi dapat dibatalkan.
     */
    public function isCancellable(): bool
    {
        return in_array($this->status, ['pending', 'confirmed']);
    }
}
