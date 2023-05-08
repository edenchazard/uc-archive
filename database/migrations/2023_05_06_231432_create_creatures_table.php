<?php

use App\Models\Family;
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
            $table->id();
            $table->string("name", 20);
            $table->unsignedTinyInteger('stage')->default(1);
            $table->text('shortDescription');
            $table->text('longDescription');
            $table->unsignedSmallInteger('requiredClicks');
            $table->unsignedTinyInteger('component');
            $table->timestamps();

            $table->foreignIdFor(Family::class);
            $table->unique(['stage', 'family_id']);
            $table->unique(['family_id', 'name']);
            $table->index('component');
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
