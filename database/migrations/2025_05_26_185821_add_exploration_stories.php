<?php

use App\Models\Creature;
use App\Models\ExplorationArea;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exploration_stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->foreignIdFor(ExplorationArea::class)->constrained();
            $table->text('story')->nullable();
            $table->text('history')->nullable();
            $table->foreignIdFor(Creature::class, 'creature_1_id')->nullable();
            $table->string('creature_1_option');
            $table->foreignIdFor(Creature::class, 'creature_2_id')->nullable();
            $table->string('creature_2_option');
            $table->foreignIdFor(Creature::class, 'creature_3_id')->nullable();
            $table->string('creature_3_option');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exploration_stories');
    }
};
