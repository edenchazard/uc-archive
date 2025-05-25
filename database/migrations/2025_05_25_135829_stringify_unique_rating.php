<?php

use App\Models\Family;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    private const RATINGS = [
        0 => null,
        1 => 'Exotic',
        2 => 'Legendary',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('families', function (Blueprint $table) {
            $table->string('unique_rating')->nullable()->change();
        });

        Family::query()->each(function (Family $family) {
            $family->mergeCasts([
                'unique_rating' => 'string',
            ]);

            if (isset(self::RATINGS[$family->unique_rating])) {
                $family->unique_rating = self::RATINGS[$family->unique_rating];
                $family->save();
            } else {
                $family->unique_rating = null;
                $family->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Family::query()->each(function (Family $family) {
            $family->unique_rating = array_search($family->unique_rating, self::RATINGS, true) ?: 0;
            $family->save();
        });

        Schema::table('families', function (Blueprint $table) {
            $table->unsignedTinyInteger('unique_rating')->nullable(false)->change();
        });
    }
};
