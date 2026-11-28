<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'room_id',
        'customer_name',
        'phone',
        'booking_date',
        'start_time',
        'duration_hours',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}