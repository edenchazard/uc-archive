<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\TrainingOption
 *
 * @property int $id
 * @property int $creature_id
 * @property string $title
 * @property string $description
 * @property int $energy_cost
 * @property string $reward
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
    use HasFactory;
}
