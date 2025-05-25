<?php

use App\Models\Family;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    private const ELEMENTS = [
        1 => 'Earth',
        2 => 'Air',
        3 => 'Spirit',
        4 => 'Water',
        5 => 'Fire',
        6 => 'Physical',
        7 => 'Unique',
        8 => 'Grass',
        9 => 'Sweet',
        10 => 'Metal',
        11 => 'Deity',
        12 => 'Moon',
        13 => 'Dream',
        14 => 'Luck',
        15 => 'Shimmer',
        16 => 'Awesomeness',
        17 => 'Tree',
        18 => 'Sparkly',
        19 => 'Love',
        20 => 'Special',
        21 => 'Wheeee',
        22 => 'Squee',
        23 => 'Poison',
        24 => 'Treeee',
        25 => 'Electric',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('families', function (Blueprint $table) {
            $table->string('element')->nullable()->change();
        });

        Family::query()->each(function (Family $family) {
            $family->mergeCasts([
                'element' => 'string',
            ]);

            if (isset(self::ELEMENTS[$family->element])) {
                $family->element = self::ELEMENTS[$family->element];
                $family->save();
            } else {
                $family->element = null;
                $family->save();
            }
        });

        Schema::table('families', function (Blueprint $table) {
            $table->string('element')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Family::query()->each(function (Family $family) {
            $family->element = array_search($family->element, self::ELEMENTS, true) ?: null;
            $family->save();
        });

        Schema::table('families', function (Blueprint $table) {
            $table->unsignedTinyInteger('element')->nullable(false)->change();
        });
    }
};
