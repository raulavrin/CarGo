<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Car;

class Appointment extends Model
{
    protected $guarded = [];

     public function property(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}