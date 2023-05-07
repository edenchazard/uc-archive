<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Creature extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function family(): BelongsTo {
        return $this->belongsTo(Family::class);
    }
}
