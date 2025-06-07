<?php

use App\Models\ShopCategory;
use App\Models\ShopTransaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
        });

        Schema::create('shop_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
        });

        Schema::create('shop_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ShopCategory::class)->constrained();
            $table->morphs('rewardable');
            $table->string('title');
            $table->unsignedBigInteger('amount');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('shop_transaction_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ShopTransaction::class)->constrained();
            $table->morphs('requireable', 'requirable_index');
            $table->unsignedBigInteger('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_transaction_requirements');
        Schema::dropIfExists('shop_transactions');
        Schema::dropIfExists('shop_categories');
    }
};
