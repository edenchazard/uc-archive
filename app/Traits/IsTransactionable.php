<?php

namespace App\Traits;

use App\Models\ShopTransaction;
use App\Models\ShopTransactionRequirement;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait IsTransactionable
{
    /**
     * @return MorphMany<ShopTransactionRequirement,$this>
     */
    public function shopTransactionRequirements(): MorphMany
    {
        return $this->morphMany(ShopTransactionRequirement::class, 'requireable');
    }

    /**
     * @return MorphMany<ShopTransaction,$this>
     */
    public function shopTransactions(): MorphMany
    {
        return $this->morphMany(ShopTransaction::class, 'rewardable');
    }
}
