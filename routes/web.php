<?php

use App\Http\Controllers\CreatureController;
use App\Http\Controllers\FamilyController;
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
        Route::get('/', 'index')->name('creatures');

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
                Route::get('/{creature}', 'showFromFamily')->where('creature', '[a-zA-Z]+')->name('creature');
            });
        });
    });
});
