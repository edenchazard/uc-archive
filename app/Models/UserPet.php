<?php

namespace App\Models;

use App\Services\Formatting\CreatureFormattingService;
use CreatureUtils;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $attributes = [
        'specialty' => 0,
        'variety' => 0,
        'nickname' => 'Placeholder',
    ];

    public function creature(): HasOne
    {
        return $this->hasOne(Creature::class);
    }

    /**
     * Returns an image url for the pet.
     */
    public function imageLink(): string
    {
        return CreatureUtils::imageLink($this);
    }

    public function specialty(): string
    {
        return CreatureUtils::specialty($this->specialty);
    }

    /**
     * Simply a shorthand for setting the creature relationship and
     * some common properties.
     *
     * @param Creature $creature The Creature model to use.
     */
    public function use(Creature $creature): self
    {
        $this->setRelation('creature', $creature);
        $this->nickname = $this->creature->name;
        return $this;
    }

    protected function shortDescriptionFormatted(): Attribute
    {
        return Attribute::make(
            get: function () {
                return (new CreatureFormattingService(
                    $this->creature->short_description,
                    [
                        '{{c:nickname}}' => $this->nickname,
                        '{{c:name}}' => $this->creature->name,
                        '{{c:family}}' => $this->creature->family->name,
                    ],
                    // If the creature has a set gender, use that. Otherwise, if
                    // not male or female, let's have a bit of fun and randomise the gender.
                    $this->gender
                ))->formatAll()->get();
            }
        );
    }

    protected function longDescriptionFormatted(): Attribute
    {
        return Attribute::make(
            get: function () {
                return (new CreatureFormattingService(
                    $this->creature->long_description,
                    [
                        '{{c:nickname}}' => $this->nickname,
                        '{{c:name}}' => $this->creature->name,
                        '{{c:family}}' => $this->creature->family->name,
                    ],
                    $this->gender
                ))->formatAll()->get();
            }
        );
    }
}
