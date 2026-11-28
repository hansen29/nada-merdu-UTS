<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'capacity',
        'hourly_rate',
        'status',
        'description',
    ];

    public function instruments(): HasMany
    {
        return $this->hasMany(Instrument::class);
    }
}