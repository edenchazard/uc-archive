<?php

use App\Models\Consumable;
use App\Models\ExplorationArea;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exploration_areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->unsignedSmallInteger('accomplishments')->default(0);
        });

        Schema::create('exploration_area_consumables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ExplorationArea::class)->constrained();
            $table->foreignIdFor(Consumable::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exploration_areas');
    }
};
