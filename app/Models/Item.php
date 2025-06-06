<?php
namespace App\Models;

use App\Interfaces\ImageLink;
use App\Traits\IsTransactionable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Str;

class Item extends Model implements ImageLink
{
    use IsTransactionable;

    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => asset(strtolower('images/items/' . Str::snake($this->name) . '.png'))
        );
    }
}
