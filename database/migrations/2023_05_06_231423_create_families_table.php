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
        /*
        
CREATE TABLE IF NOT EXISTS `creatures_families` (
  `familyID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `family_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `has_varieties` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `rarity` tinyint(2) unsigned NOT NULL DEFAULT '1',
  *`type` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `in_basket` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `deny_ne` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `unique_rating` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `gender_only` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `release_day` date NOT NULL,
  `dbegin` date NOT NULL,
  `dend` date NOT NULL,
  `every_year_until` smallint(4) NOT NULL DEFAULT '2099',
  PRIMARY KEY (`familyID`),
  KEY `in_basket` (`in_basket`),
  KEY `rarity` (`rarity`),
  KEY `every_year_until` (`dbegin`,`dend`,`every_year_until`,`unique_rating`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=194 ;*/
        Schema::create('families', function (Blueprint $table) {
            $table->comment('Table for creature families.');
            $table->id();
            $table->timestamps();
            $table->string('name', 36);
            $table->unsignedTinyInteger('rarity')->default(1);
            $table->boolean('inBasket')->default(1);
            $table->boolean('allowExalt')->default(1);
            $table->unsignedTinyInteger('gender')->default(3);
            $table->unsignedTinyInteger('uniqueRating')->default(0);
            $table->date('released')->useCurrent();
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
