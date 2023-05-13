<?php

use App\Http\Controllers\CreatureController;
use App\Http\Controllers\FamilyController;
use App\Models\Creature;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('creatures')->group(function () {
    Route::controller(FamilyController::class)->group(function () {
        /**
         * Create a new family
         */
        // Route::post('/new', 'store');

        /**
         * Show all families
         */
        Route::get('/all', 'index')->name('creatures');

        Route::prefix('{family}')->where(['family', '[a-zA-Z]+'])->group(function () {
            /** 
             * Show a family of creatures
             */
            Route::get('/', 'show')->name('family');

            Route::controller(CreatureController::class)->group(function () {
                /**
                 * Add a new creature to the family
                 */
                // Route::post('/new', 'store');

                /**
                 * Show an individual creature.
                 */
                Route::get('/{creature}', 'showByTaxonomy')->where('creature', '[a-zA-Z]+')->name('creature');
            });
        });
    });

    /**
     * Redirect creatures/{name} to /creatures/{resolved name}/{resolved name}
     * Or in the case of ambiguous matches, return the matches and let the user
     * decide where to go.
     */
    Route::get('/{name}', function (Request $request, string $name) {
        // There are some creatures whose names are not unique, such as 'Egg'!
        // This means if one of these is provided, we should instead
        // give the user several results.
        // But if only one match is found, we can just redirect the user to the correct
        // page
        $results = Creature::where('name', $name)->get();
        if ($results->count() > 1) {
            return $results->all();
        }

        $creature = &$results[0];
        $familyName = $creature->resolvedFamily()->name;
        return redirect("/creatures/$familyName/$creature->name");
    });
});
