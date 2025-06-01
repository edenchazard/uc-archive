<?php

use App\Models\Consumable;
use App\Models\Family;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('creatures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Family::class)->constrained();
            $table->foreignIdFor(Consumable::class)->constrained();
            $table->string('name');
            $table->unsignedTinyInteger('stage')->default(1);
            $table->unsignedSmallInteger('required_clicks')->nullable();
            $table->text('short_description');
            $table->text('long_description');
            $table->string('artist')->nullable();
            $table->timestamps();

            $table->unique(['stage', 'family_id']);
            $table->unique(['family_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('creatures');
    }
};
