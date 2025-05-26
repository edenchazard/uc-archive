<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExplorationStory extends Model
{
    /**
     * @return BelongsTo<ExplorationArea,$this>
     */
    public function explorationArea(): BelongsTo
    {
        return $this->belongsTo(ExplorationArea::class);
    }
}
