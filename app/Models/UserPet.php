<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\SpecialtyEnum;
use App\Services\Formatting\CreatureFormattingService;
use Database\Factories\UserPetFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\File;
use Str;

/**
 * App\Models\UserPet
 *
 * @property int $id
 * @property int $creature_id
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
        'specialty' => SpecialtyEnum::class,
    ];

    protected $attributes = [
        'specialty' => SpecialtyEnum::None,
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
     * @return Attribute<string|null,never>
     */
    protected function imageLink(): Attribute
    {
        return Attribute::make(
            get: function () {
                $creature = $this->creature;

                $path = Str::of("images/creatures/{$creature->family->name}/")
                    ->when(
                        $this->specialty->value > 0 && $this->specialty->value <= 2,
                        fn ($path) =>
                        $path->append("{$this->specialty->friendlyName()}_")
                    )
                    ->when(
                        $this->variety > 0,
                        fn ($path) =>
                        $path->append("{$this->variety}_")
                    )
                    // creatures with their family name don't follow the same url format...
                    ->append($creature->family->name)
                    ->when(
                        $creature->family->name !== $creature->name,
                        fn ($path) =>
                        $path->append("_{$creature->name}")
                    )
                    ->lower()
                    ->when(
                        fn ($path) => File::exists(public_path("{$path}.png")),
                        fn ($path) =>
                        $path->append('.png'),
                        fn ($path) => $path->when(
                            File::exists(public_path("{$path}.gif")),
                            fn ($path) => $path->append('.gif'),
                        )
                    );

                return $path->contains('.') ? asset($path) : null;
            }
        );
    }
}
