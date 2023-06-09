<?php

use App\Models\Family;
use App\Services\Creatures\CreatureUtils;
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
        Schema::create('creatures', function (Blueprint $table) {
            $table->comment('Table for individual creatures themselves.');

            $table->unsignedSmallInteger('id', true)->autoIncrement();
            $table->string("name", 20);
            $table->unsignedTinyInteger('stage')->default(1);
            $table->text('short_description');
            $table->text('long_description');
            $table->unsignedSmallInteger('required_clicks');

            foreach (CreatureUtils::getPossibleStats() as $skill) {
                $table->unsignedTinyInteger("max_{$skill}")->default(0);
            }

            $table->unsignedSmallInteger('family_id');
            //    $table->foreign('family_id')->references('id')->on('families')->restrictOnDelete()->cascadeOnUpdate();
            $table->unsignedTinyInteger('component_id')->index();
            //    $table->foreign('component_id')->references('id')->on('consumables')->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamps();

            $table->unique(['stage', 'family_id']);
            $table->unique(['family_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creatures');
    }
};
