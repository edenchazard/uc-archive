<?php

namespace App\Models;

use App\Enums\ConsumableTypeEnum;
use App\Interfaces\ImageLink;
use App\Traits\IsTransactionable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
class Consumable extends Model implements ImageLink
{
    use IsTransactionable;

    /**
     * @var array<string,string>
     */
    protected $casts = [
        'type' => ConsumableTypeEnum::class,
    ];

    /**
     * @return BelongsToMany<ExplorationArea,$this>
     */
    public function explorationAreas(): BelongsToMany
    {
        return $this->belongsToMany(
            ExplorationArea::class,
            table: 'exploration_area_consumables'
        );
    }

    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => asset(
                Str::of('images/consumables/')
                    ->append(Str::slug($this->name, '_'))
                    ->append('.webp')
                    ->lower()
            )
        );
    }
}
