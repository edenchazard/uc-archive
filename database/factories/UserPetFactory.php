<?php

namespace Database\Factories;

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
        return $this
            ->state([
                'nickname' => $creature->name,
            ])
            ->afterMaking(fn ($self) => $self->setRelation('creature', $creature));
    }
}
