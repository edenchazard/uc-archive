<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShopCategory extends Model
{
    /**
     * @return HasMany<ShopTransaction,$this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(ShopTransaction::class);
    }
}
