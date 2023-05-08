<?php

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
        Schema::create('training_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('creature_id');
            $table->string('title', 50);
            $table->text('description');
            $table->tinyInteger('energyCost')->default(5);
            $table->string('reward', 100);
            $table->index('creature_id');
            $table->timestamps();
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
