<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ConsumableSeeder::class,
            FamilySeeder::class,
            AltSeeder::class,
            CreatureSeeder::class,
            TrainingOptionSeeder::class,
            ExplorationAreaSeeder::class,
            ExplorationAreaConsumableSeeder::class,
            ExplorationStorySeeder::class,
        ]);
    }
}
