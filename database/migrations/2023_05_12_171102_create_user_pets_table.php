<?php

use App\Models\Creature;
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
        Schema::create('user_pets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Creature::class);
            $table->unsignedTinyInteger('specialty')->default(0);
            // todo if we add varieties, we'll change this to a foreign key, probably.
            $table->unsignedSmallInteger('variety')->default(0);
            $table->string('nickname', 40);
            $table->unsignedTinyInteger('gender')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pets');
    }
};
