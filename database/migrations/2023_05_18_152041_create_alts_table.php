<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alts', function (Blueprint $table) {
            $table->comment('Alternate family images.');

            $table->unsignedSmallInteger('id', true);
            $table->unsignedSmallInteger('family_id');
            $table->string('name', 20);
            $table->boolean('enabled')->default(0);
            $table->timestamps();
            $table->unique(['family_id', 'name']);
            //$table->foreign('family_id')->references('id')->on('families')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alts');
    }
};
