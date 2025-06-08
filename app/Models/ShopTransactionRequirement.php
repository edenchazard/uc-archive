<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOneOrMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Relation;

class ShopTransactionRequirement extends Model
{
    /**
     * @return BelongsTo<ShopTransaction,$this>
     */
    public function shopTransaction(): BelongsTo
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
