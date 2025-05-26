<?php

namespace App\Models;

use App\Enums\ConsumableTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Str;

/**
 * App\Models\Consumable
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable query()
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consumable whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Consumable extends Model
{
    /**
     * @var array<string,string>
     */
    protected $casts = [
        'type' => ConsumableTypeEnum::class,
    ];

    /**
     * @return Attribute<string,never>
     */
    protected function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => asset(strtolower('images/components/' . Str::snake($this->name) . '.png'))
        );
    }
}
