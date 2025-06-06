<?php

namespace App\Models;

use App\Services\Formatting\FormattingService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExplorationStory extends Model
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
}
