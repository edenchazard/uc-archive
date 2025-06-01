<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * App\Models\Creature
 *
 * @property int $id
 * @property string $name
 * @property int $stage
 * @property string $short_description
 * @property string $long_description
 * @property int $required_clicks
 * @property int $max_strength
 * @property int $max_agility
 * @property int $max_speed
 * @property int $max_intelligence
 * @property int $max_wisdom
 * @property int $max_charisma
 * @property int $max_creativity
 * @property int $max_willpower
 * @property int $max_focus
 * @property int $family_id
 * @property int $component_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Consumable|null $consumable
 * @property-read \App\Models\Family $family
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TrainingOption> $trainingOptions
 * @property-read int|null $training_options_count
 * @method static \Illuminate\Database\Eloquent\Builder|Creature locate(string|int $family, string|int $creature)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Creature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Creature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereComponentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxAgility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxCharisma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxCreativity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxFocus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxIntelligence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxStrength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxWillpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereMaxWisdom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereRequiredClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Creature orderByFamilyName()
 * @mixin \Eloquent
 */
class Creature extends Model
{
    /**
     * @var array<string,string>
     */
    protected $casts = [
        'stage' => 'integer',
        'artist' => 'string',
        'max_stats' => AsCollection::class,
    ];

    /**
     * @return BelongsTo<Family,$this>
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    /**
     * @return BelongsTo<Consumable,$this>
     */
    public function consumable(): BelongsTo
    {
        return $this->belongsTo(Consumable::class);
    }

    /**
     * @return HasMany<TrainingOption,$this>
     */
    public function trainingOptions(): HasMany
    {
        return $this->hasMany(TrainingOption::class);
    }

    /**
     * @return BelongsToMany<ExplorationStory,$this>
     */
    public function explorationStories(): BelongsToMany
    {
        return $this->belongsToMany(ExplorationStory::class, 'exploration_story_option');
    }

    /**
     * @return HasMany<ExplorationStoryOption,$this>
     */
    public function explorationStoryOptions(): HasMany
    {
        return $this->hasMany(ExplorationStoryOption::class);
    }

    /**
     * Returns the nearest previous and nearest next creatures adjacent to this
     * creature in terms of id. Skips missing ids.
     * @return Collection<string,$this|null>
     */
    public function getChronologicalAdjacents(): Collection
    {
        $collection = collect([
            'previous' => self::query()->where('id', '<', $this->id)->orderByDesc('id')->first(),
            'next' => self::query()->where('id', '>', $this->id)->orderBy('id')->first(),
        ]);

        return $collection;
    }

    /**
     * Calculate the max possible stat value for this creature.
     * @return Attribute<int,never>
     */
    protected function maxStatPoints(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->max_stats->sum()
        );
    }
}
