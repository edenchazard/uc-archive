<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alt extends Model
{
    use HasFactory;

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}
