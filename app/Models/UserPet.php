<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Services\Formatting\CreatureFormattingService;
use CreatureUtils;
use Database\Factories\UserPetFactory;
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Creature $creature
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
    /**
     * @use HasFactory<UserPetFactory>
     */
    use HasFactory;

    protected $guarded = [];

    /**
     * @var array<string,string>
     */
    protected $casts = [
        'gender' => GenderEnum::class,
    ];

    protected $attributes = [
        'specialty' => 0,
        'variety' => 0,
        'nickname' => 'Placeholder',
    ];

    /**
     * @return HasOne<Creature, $this>
     */
    public function creature(): HasOne
    {
        return $this->hasOne(Creature::class);
    }

    public function specialty(): string
    {
        return CreatureUtils::specialty($this->specialty);
    }

    /**
     * @return Attribute<string,never>
     */
    protected function shortDescription(): Attribute
    {
        return Attribute::make(
            get: function () {
                return (new CreatureFormattingService(
                    $this->creature->short_description,
                    $this->gender,
                    [
                        '{{c:nickname}}' => $this->nickname,
                        '{{c:name}}' => $this->creature->name,
                        '{{c:family}}' => $this->creature->family->name,
                    ],
                ))
                    ->formatAll()
                    ->get();
            }
        );
    }

    /**
     * @return Attribute<string,never>
     */
    protected function longDescription(): Attribute
    {
        return Attribute::make(
            get: function () {
                return (new CreatureFormattingService(
                    $this->creature->long_description,
                    $this->gender,
                    [
                        '{{c:nickname}}' => $this->nickname,
                        '{{c:name}}' => $this->creature->name,
                        '{{c:family}}' => $this->creature->family->name,
                    ],
                ))
                    ->formatAll()
                    ->get();
            }
        );
    }

    /**
     * @return Attribute<string,never>
     */
    protected function imageLink(): Attribute
    {
        return Attribute::make(
            get: function () {
                $creature = $this->creature;
                $parts = collect([]);

                if ($this->specialty > 0 && $this->specialty <= 2) {
                    $parts->push(CreatureUtils::specialty($this->specialty));
                }

                if ($this->variety) {
                    $parts->push($this->variety);
                }

                // creatures with their family name don't follow the same url format...
                $parts->push($creature->family->name);

                if ($creature->family->name !== $creature->name) {
                    $parts->push($creature->name);
                }

                $path = strtolower("/images/creatures/{$creature->family->name}/{$parts->join('_')}.png");

                return asset($path);
            }
        );
    }
}
