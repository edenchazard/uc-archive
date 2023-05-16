<?php

namespace App\Models;

use CreatureUtils;
use Date;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @mixin \Eloquent
 */
class Family extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'deny_exalt' => 'boolean',
        'in_basket' => 'boolean'
    ];

    public function stages(): HasMany
    {
        return $this->hasMany(Creature::class)->orderBy('stage', 'asc');
    }

    /**
     * Return a family by family name
     * @param string $name The family name.
     * @return Family
     */
    public static function findByName(string $name): Family
    {
        return Family::firstWhere('name', $name);
    }

    public function rarity(): string
    {
        return CreatureUtils::rarity($this->rarity);
    }

    public function gender(): string
    {
        return CreatureUtils::gender($this->gender);
    }

    public function element(): string
    {
        return CreatureUtils::element($this->element);
    }

    public function specialty(): string
    {
        return CreatureUtils::specialty($this->specialty);
    }

    public function released(): string
    {
        return (new DateTime($this->released))->format('jS F o');
    }

    public function uniqueRating(): string
    {
        return CreatureUtils::unique($this->unique_rating);
    }

    /**
     * Get all stats in a single collection.
     * @return \Illuminate\Database\Eloquent\Collection<string, int>
     */
    public function getBaseStats()
    {
        return CreatureUtils::getPossibleStats()->flip()->map(fn ($val, $key) => $this["base_$key"]);
    }
}
