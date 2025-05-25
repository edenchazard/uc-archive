<?php

namespace App\Models;

use App\Enums\ElementTypeEnum;
use App\Enums\UniqueRatingEnum;
use CreatureUtils;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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
class Family extends Model
{
    protected $guarded = [];

    /**
     * @var array<string,string>
     */
    protected $casts = [
        'deny_exalt' => 'boolean',
        'in_basket' => 'boolean',
        'element' => ElementTypeEnum::class,
        'unique_rating' => UniqueRatingEnum::class,
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
        return $this->hasMany(Creature::class)->orderBy('stage', 'asc');
    }

    /**
     * @return HasMany<Alt, $this>
     */
    public function alts(): HasMany
    {
        return $this->hasMany(Alt::class);
    }

    public function rarity(): string
    {
        return CreatureUtils::rarity($this->rarity);
    }

    public function gender(): string
    {
        return CreatureUtils::gender($this->gender);
    }

    public function specialty(): string
    {
        return CreatureUtils::specialty($this->specialty);
    }

    public function released(): string
    {
        return (new DateTime($this->released))->format('jS F o');
    }

    /**
     * Get all stats in a single collection.
     * @return Collection<string, int>
     */
    public function getBaseStats(): Collection
    {
        return CreatureUtils::getPossibleStats()->flip()->map(fn ($val, $key) => $this["base_{$key}"]);
    }
}
