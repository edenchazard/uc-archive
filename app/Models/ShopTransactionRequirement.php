<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ShopTransactionRequirement extends Model
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
    public function requireable(): MorphTo
    {
        return $this->morphTo();
    }
}
