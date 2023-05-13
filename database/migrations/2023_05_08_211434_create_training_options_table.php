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
            $table->comment('Table for creature training options.');

            $table->unsignedSmallInteger('id')->autoIncrement();
            $table->unsignedSmallInteger('creature_id')->index();
            $table->string('title', 50);
            $table->text('description');
            $table->tinyInteger('energy_cost')->default(5);
            $table->string('reward', 100);
            $table->timestamps();

            //$table->foreign('creature_id')->references('id')->on('creatures')->restrictOnDelete()->cascadeOnUpdate();
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
