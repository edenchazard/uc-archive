<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ShopTransaction extends Model
{
    /**
     * @return BelongsTo<ShopCategory,$this>
     */
    public function shopCategory(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class);
    }

    /**
     * @return HasMany<ShopTransactionRequirement,$this>
     */
    public function requirements(): HasMany
    {
        return $this->hasMany(ShopTransactionRequirement::class);
    }

    /**
     * @return MorphTo<Model,$this>
     */
    public function rewardable(): MorphTo
    {
        return $this->morphTo();
    }
}
