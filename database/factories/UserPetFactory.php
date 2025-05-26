<?php

namespace Database\Factories;

use App\Models\Creature;
use App\Services\Creatures\CreatureGender;
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
            $remember[$key] = CreatureGender::get($creature->family->gender);
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
