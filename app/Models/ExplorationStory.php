<?php

namespace App\Models;

use App\Interfaces\DirectLink;
use App\Services\Formatting\FormattingService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExplorationStory extends Model implements DirectLink
{
    /**
     * @var array<string,string>
     */
    protected $casts = [
        'story' => 'string',
    ];

    /**
     * @return BelongsTo<ExplorationArea,$this>
     */
    public function explorationArea(): BelongsTo
    {
        return $this->belongsTo(ExplorationArea::class);
    }

    /**
     * @return HasMany<ExplorationStoryOption,$this>
     */
    public function storyOptions(): HasMany
    {
        return $this->hasMany(ExplorationStoryOption::class);
    }

    /**
     * @return Attribute<string,never>
     */
    protected function formattedStory(): Attribute
    {
        return Attribute::make(
            get: function () {
                return (new FormattingService($this->story ?? '', []))
                    ->formatAll()
                    ->get();
            }
        );
    }

    public function directLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route('exploration.area.story.show', [$this->explorationArea, $this])
        );
    }
}
