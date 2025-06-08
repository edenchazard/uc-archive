<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ShopTransactionReward extends Model
{
    /**
     * @return BelongsTo<ShopTransaction,$this>
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(ShopTransaction::class);
    }

    /**
     * @return MorphTo<Model,$this>
     */
    public function rewardable(): MorphTo
    {
        return $this->morphTo();
    }
}
