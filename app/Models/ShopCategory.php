<?php

namespace App\Models;

use App\Interfaces\DirectLink;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShopCategory extends Model implements DirectLink
{
    /**
     * @return HasMany<ShopTransaction,$this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(ShopTransaction::class);
    }

    public function directLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route('shop.category.show', $this)
        );
    }
}
