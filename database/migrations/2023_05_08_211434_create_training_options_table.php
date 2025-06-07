<?php

use App\Models\Creature;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('training_options', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Creature::class);
            $table->string('title');
            $table->string('reward');
            $table->text('description');
            $table->unsignedTinyInteger('energy_cost')->default(5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_options');
    }
};
