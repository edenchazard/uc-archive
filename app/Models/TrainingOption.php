<?php

namespace App\Models;

use App\Services\Formatting\CreatureFormattingService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Str;

/**
 * App\Models\TrainingOption
 *
 * @property int $id
 * @property int $creature_id
 * @property string $title
 * @property string $description
 * @property int $energy_cost
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
     * @var array<string,string>
     */
    protected $casts = [
        'reward' => 'string',
    ];

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
            $pet->gender,
            [
                '{{c:nickname}}' => $pet->nickname,
                '{{c:name}}' => $this->creature->name,
                '{{c:family}}' => $this->creature->family->name,
                '*' => $pet->nickname,
            ],
        ))
            ->formatAll()
            ->get();
    }

    /**
     * @return Attribute<string,never>
     */
    protected function formattedReward(): Attribute
    {
        $generic = ['strength', 'agility', 'speed', 'intelligence', 'wisdom', 'charisma', 'creativity', 'willpower', 'focus'];

        return Attribute::make(
            get: function () use ($generic) {
                $grouped = collect(explode(',', $this->reward))
                    ->sortBy(
                        fn (string $reward) => Str::beforeLast($reward, ' ')
                    )
                    ->groupBy(function (string $reward) use ($generic) {
                        if (! in_array(Str::afterLast($reward, ' '), $generic)) {
                            return 'special';
                        }
                        return 'generic';
                    });

                return collect($grouped->get('special', []))
                    ->flatten()
                    ->map(fn (string $reward) => Str::wrap($reward, '<strong>', '</strong>'))
                    ->merge($grouped->get('generic', []))
                    ->map(fn (string $reward) => Str::title($reward))
                    ->implode(', ');
            }
        );
    }
}
