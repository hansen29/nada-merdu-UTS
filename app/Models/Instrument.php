<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'name',
        'category',
        'stock',
        'rental_rate',
        'condition',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}