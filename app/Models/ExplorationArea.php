<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Str;

class ExplorationArea extends Model
{
    /**
     * @return HasMany<ExplorationStory,$this>
     */
    public function explorationStories(): HasMany
    {
        return $this->hasMany(ExplorationStory::class);
    }

    /**
     * @return BelongsToMany<Consumable,$this>
     */
    public function consumables(): BelongsToMany
    {
        return $this->belongsToMany(Consumable::class, 'exploration_area_consumables');
    }

    /**
     * @return Attribute<string,never>
     */
    protected function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn () => asset(strtolower('images/exploration/' . Str::snake($this->name) . '.webp'))
        );
    }
}
