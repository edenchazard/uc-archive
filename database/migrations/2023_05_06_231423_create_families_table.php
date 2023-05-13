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

            $table->unsignedSmallInteger('id')->autoIncrement();

            $table->string('name', 36);
            $table->boolean('in_basket')->default(1);
            $table->boolean('deny_exalt')->default(1);
            $table->boolean('has_alts')->default(0);
            $table->unsignedTinyInteger('gender')->default(3);
            $table->unsignedTinyInteger('rarity')->default(1);
            $table->unsignedTinyInteger('unique_rating')->default(0);
            $table->unsignedTinyInteger('element')->default(0);
            $table->date('released')->useCurrent();
            $table->date('availability_begin')->default('1970-01-01');
            $table->date('availability_end')->default('1970-01-01');

            $skills = ['strength', 'agility', 'speed', 'intelligence', 'wisdom', 'charisma', 'creativity', 'willpower', 'focus'];

            foreach ($skills as $skill) {
                $table->unsignedTinyInteger("base_{$skill}")->default(0);
            }

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
