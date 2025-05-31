<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Str;

/**
 * @property-read Creature $creature
 */
class ExplorationStoryOption extends Pivot
{
    /**
     * @var array<string,string>
     */
    protected $casts = [
        'description' => 'string',
    ];

    /**
     * @return BelongsTo<ExplorationStory,$this>
     */
    public function explorationStory(): BelongsTo
    {
        return $this->belongsTo(ExplorationStory::class);
    }

    /**
     * @return BelongsTo<Creature,$this>
     */
    public function creature(): BelongsTo
    {
        return $this->belongsTo(Creature::class);
    }

    /**
     * @return HasOneThrough<ExplorationArea,ExplorationStory,$this>
     */
    public function explorationArea(): HasOneThrough
    {
        return $this->hasOneThrough(
            ExplorationArea::class,
            ExplorationStory::class,
            'id',
            'id',
            localKey: 'exploration_story_id',
            secondLocalKey: 'exploration_area_id'
        );
    }

    /**
     * @return HasOneThrough<Family,Creature,$this>
     */
    public function family(): HasOneThrough
    {
        return $this->hasOneThrough(
            Family::class,
            Creature::class,
            'id',
            'id',
            localKey: 'creature_id',
            secondLocalKey: 'family_id'
        );
    }

    /**
     * @return Attribute<string,never>
     */
    protected function formattedDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::replace('*', $this->creature->name, $this->description ?? '')
        );
    }
}
