<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Alt
 *
 * @property int $id
 * @property int $family_id
 * @property string $name
 * @property int $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Family|null $family
 * @method static \Illuminate\Database\Eloquent\Builder|Alt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alt query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alt whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Alt extends Model
{

    /**
     * @return BelongsTo<Family, $this>
     */
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}
