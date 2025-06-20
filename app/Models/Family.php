<?php

namespace App\Models;

use App\Enums\ElementTypeEnum;
use App\Enums\RarityCategoryEnum;
use App\Enums\UniqueRatingEnum;
use App\Interfaces\DirectLink;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Family
 *
 * @property int $id
 * @property string $name
 * @property int $in_basket
 * @property int $deny_exalt
 * @property int $has_alts
 * @property int $gender
 * @property int $rarity
 * @property int $unique_rating
 * @property int $element
 * @property string $released
 * @property string $availability_begin
 * @property string $availability_end
 * @property int $base_strength
 * @property int $base_agility
 * @property int $base_speed
 * @property int $base_intelligence
 * @property int $base_wisdom
 * @property int $base_charisma
 * @property int $base_creativity
 * @property int $base_willpower
 * @property int $base_focus
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Creature> $stages
 * @property-read int|null $stages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Family newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Family newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Family query()
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereAvailabilityBegin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereAvailabilityEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseAgility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseCharisma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseCreativity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseFocus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseIntelligence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseStrength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseWillpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereBaseWisdom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereDenyExalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereElement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereHasAlts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereInBasket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereRarity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereReleased($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereUniqueRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Family whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Alt> $alts
 * @property-read int|null $alts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Creature> $creatures
 * @property-read int|null $creatures_count
 * @mixin \Eloquent
 */
class Family extends Model implements DirectLink
{
    protected $guarded = [];

    /**
     * @var array<string,string>
     */
    protected $casts = [
        'deny_exalt' => 'boolean',
        'in_basket' => 'boolean',
        'released' => 'datetime',
        'gender' => 'integer',
        'element' => ElementTypeEnum::class,
        'unique_rating' => UniqueRatingEnum::class,
        'rarity' => RarityCategoryEnum::class,
        'base_stats' => AsCollection::class,
    ];

    /**
     * Just an alias for stages, basically.
     * @return HasMany<Creature, $this>
     */
    public function creatures(): HasMany
    {
        return $this->stages();
    }

    /**
     * @return HasMany<Creature, $this>
     */
    public function stages(): HasMany
    {
        return $this
            ->hasMany(Creature::class)
            ->chaperone()
            ->orderBy('stage');
    }

    /**
     * @return HasMany<Alt, $this>
     */
    public function alts(): HasMany
    {
        return $this->hasMany(Alt::class);
    }

    public function directLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route('creatures.family.show', $this)
        );
    }
}
