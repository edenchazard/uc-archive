<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('consumables', function (Blueprint $table) {
            $table->string('slug')->unique()->after('id');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->string('slug')->unique()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consumables', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
