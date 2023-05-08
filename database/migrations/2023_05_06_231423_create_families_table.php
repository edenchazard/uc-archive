<?php

use App\Models\Creature;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->comment('Table for creature families.');
            $table->id();
            $table->string('name', 36);
            $table->boolean('inBasket')->default(1);
            $table->boolean('allowExalt')->default(1);
            $table->boolean('hasAlts')->default(0);
            $table->unsignedTinyInteger('gender')->default(3);
            $table->unsignedTinyInteger('rarity')->default(1);
            $table->unsignedTinyInteger('uniqueRating')->default(0);
            $table->string('element', 15)->default('none');
            $table->date('released')->useCurrent();
            $table->date('availabilityBegin')->default('1970-01-01');
            $table->date('availabilityEnd')->default('1970-01-01');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families');
    }
};
