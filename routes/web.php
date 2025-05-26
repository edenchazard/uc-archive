<?php

use App\Http\Controllers\CreatureController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
