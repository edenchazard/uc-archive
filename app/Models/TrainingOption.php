<?php

namespace App\Models;

use App\Services\Formatting\CreatureFormattingService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TrainingOption
 *
 * @property int $id
 * @property int $creature_id
 * @property string $title
 * @property string $description
 * @property int $energy_cost
 * @property string $reward
 * @property-read Creature $creature
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereCreatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereEnergyCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrainingOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TrainingOption extends Model
{
    /**
     * @return BelongsTo<Creature, $this>
     */
    public function creature(): BelongsTo
    {
        return $this->belongsTo(Creature::class);
    }

    public function format(UserPet $pet): string
    {
        return (new CreatureFormattingService(
            $this->description,
            [
                '{{c:nickname}}' => $pet->nickname,
                '{{c:name}}' => $this->creature->name,
                '{{c:family}}' => $this->creature->family->name,
                '*' => $pet->nickname,
            ],
            $this->gender
        ))->formatAll()->get();
    }
}
