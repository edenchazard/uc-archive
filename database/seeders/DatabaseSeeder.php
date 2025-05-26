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
            ExplorationAreaSeeder::class,
            ConsumableSeeder::class,
            ExplorationAreaConsumableSeeder::class,
            FamilySeeder::class,
            CreatureSeeder::class,
            ExplorationStorySeeder::class,
            TrainingOptionSeeder::class,
            AltSeeder::class,
        ]);
    }
}
