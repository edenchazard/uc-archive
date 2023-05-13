<?php

namespace App\Models;

use CreatureUtils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\UserPet
 *
 * @property int $id
 * @property int $creature_id
 * @property int $specialty
 * @property int $variety
 * @property string $nickname
 * @property int $gender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Creature|null $creature
 * @method static \Database\Factories\UserPetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereCreatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereSpecialty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPet whereVariety($value)
 * @mixin \Eloquent
 */
class UserPet extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creature(): HasOne
    {
        return $this->hasOne(Creature::class);
    }

    public function imageLink(): string
    {
        return CreatureUtils::imageLink($this);
    }
}
