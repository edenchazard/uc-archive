<?php

use App\Http\Controllers\ComponentController;
use App\Http\Controllers\CreatureController;
use App\Http\Controllers\ExplorationController;
use App\Http\Controllers\ExplorationStoryController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\HomeController;
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
});

Route::prefix('/exploration')->name('exploration.')->group(function () {
    Route::get('/', [ExplorationController::class, 'index'])->name('index');

    Route::prefix('/{explorationArea:slug}')->name('area.')->group(function () {
        Route::get('/', [ExplorationController::class, 'show'])->name('show');
        Route::get('/{explorationStory:slug}', [ExplorationStoryController::class, 'show'])->name('story.show');
    });
});
