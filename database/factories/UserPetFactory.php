<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Models\Creature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPet>
 */
class UserPetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    /**
     * Indicate that the user pet is a placeholder.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function mockCreature(Creature $creature): self
    {
        static $remember = [];

        $key = "gender-{$creature->family->name}";

        if (! isset($remember[$key])) {
            if ($creature->family->gender === 3) {
                $remember[$key] = GenderEnum::from(rand(0, 1));
            } elseif ($creature->family->gender === 2) {
                $remember[$key] = GenderEnum::Dual;
            } else {
                $remember[$key] = GenderEnum::from($creature->family->gender);
            }
        }

        $defaultGender = $remember[$key];

        return $this
            ->state([
                'nickname' => $creature->name,
                'gender' => $defaultGender,
            ])
            ->afterMaking(fn ($self) => $self->setRelation('creature', $creature));
    }
}
