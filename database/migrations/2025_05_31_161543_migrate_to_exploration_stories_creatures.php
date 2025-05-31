<?php

use App\Models\Creature;
use App\Models\ExplorationStory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exploration_story_option', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ExplorationStory::class)->constrained();
            $table->foreignIdFor(Creature::class)->constrained();
            $table->unsignedTinyInteger('order')->default(0);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exploration_story_option');
    }
};
