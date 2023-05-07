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
            /*
  `familyID` tinyint(3) unsigned NOT NULL,
  `creature_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `creatureID` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `stage` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `visual_description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lifestyle` text COLLATE utf8_unicode_ci NOT NULL,
  `required_clicks` smallint(4) unsigned NOT NULL,
  `component` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`creatureID`),
  UNIQUE KEY `familyID` (`stage`,`familyID`),
  KEY `required_clicks` (`required_clicks`),
  KEY `familyID_2` (`familyID`)*/
            $table->comment('Table for individual creatures themselves.');
            $table->id();
            $table->timestamps();
            $table->string("name", 36);
            $table->unsignedTinyInteger('stage');
            $table->text('shortDescription');
            $table->text('longDescription');
            $table->unsignedSmallInteger('requiredClicks');
            $table->unsignedTinyInteger('component');
            
            $table->foreignIdFor(Family::class);
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
