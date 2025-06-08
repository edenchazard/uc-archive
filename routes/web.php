<?php

use App\Http\Controllers\ComponentController;
use App\Http\Controllers\CreatureController;
use App\Http\Controllers\ExplorationController;
use App\Http\Controllers\ExplorationStoryController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('creatures')->name('creatures.')->group(function () {
    Route::get('/search', [FamilyController::class, 'search'])->name('search');

    /**
     * Show all families
     */
    Route::get('/', [FamilyController::class, 'index'])->name('index');
    /**
     * Specific family
     */
    Route::prefix('{family:slug}')->name('family.')->group(function () {
        Route::get('/', [FamilyController::class, 'show'])
            ->name('show')
            ->missing(fn ($query) => to_route('creatures.search', [
                'query' => $query,
            ]));
        /**
         * Show an individual creature.
         */
        Route::get('/{creature:slug}', [CreatureController::class, 'show'])
            ->name('creature.show')
            ->scopeBindings()
            ->missing(fn ($query) => to_route('creatures.search', [
                'query' => $query,
            ]));
    });
});

Route::prefix('/components')->name('components.')->group(function () {
    Route::get('/', [ComponentController::class, 'index'])->name('index');
    Route::get('/{consumable:slug}', [ComponentController::class, 'show'])->name('show');
});

Route::prefix('/exploration')->name('exploration.')->group(function () {
    Route::get('/', [ExplorationController::class, 'index'])->name('index');

    Route::prefix('/{explorationArea:slug}')->name('area.')->group(function () {
        Route::get('/', [ExplorationController::class, 'show'])->name('show');
        Route::get('/{explorationStory:slug}', [ExplorationStoryController::class, 'show'])->name('story.show');
    });
});

Route::prefix('/shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{shopCategory:slug}', [ShopController::class, 'show'])->name('category.show');
});

Route::prefix('/items')->name('items.')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('index');
    Route::get('/{item:slug}', [ItemController::class, 'show'])->name('show');
});
