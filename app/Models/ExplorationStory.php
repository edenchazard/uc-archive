<?php

namespace App\Models;

use App\Services\Formatting\FormattingService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo<Creature,$this>
     */
    public function creature1(): BelongsTo
    {
        return $this->belongsTo(Creature::class, 'creature_1_id');
    }

    /**
     * @return BelongsTo<Creature,$this>
     */
    public function creature2(): BelongsTo
    {
        return $this->belongsTo(Creature::class, 'creature_2_id');
    }

    /**
     * @return BelongsTo<Creature,$this>
     */
    public function creature3(): BelongsTo
    {
        return $this->belongsTo(Creature::class, 'creature_3_id');
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
