<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Creature extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function family(): BelongsTo {
        return $this->belongsTo(Family::class);
    }

    public function consumable(): HasOne {
        return $this->hasOne(Consumable::class, 'id', 'component');
    }
}
