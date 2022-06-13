<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    public function fridgeroom(): BelongsTo
    {
        return $this->belongsTo(Fridgeroom::class, 'fridgeroom_id');
    }
}
