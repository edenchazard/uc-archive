<?php

namespace App\Models;

use App\Interfaces\DirectLink;
use App\Interfaces\ImageLink;
use App\Traits\IsTransactionable;
use Illuminate\Database\Eloquent\Attributes\RouteKey;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Str;

#[RouteKey('slug')]
class Item extends Model implements DirectLink, ImageLink
{
    use IsTransactionable;

    #[\Override]
    public function directLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route('items.show', $this)
        );
    }

    #[\Override]
    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => asset(
                Str::of('images/items/')
                    ->append(Str::slug($this->name, '_'))
                    ->append('.webp')
                    ->lower()
            )
        );
    }
}
