<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function fridgerooms(): HasMany
    {
        return $this->hasMany(Fridgeroom::class, 'location_id');
    }
}
