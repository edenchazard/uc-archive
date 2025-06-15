<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaravelPlaywrightController;

Route::prefix('/__playwright__')->name('playwright.')->group(function () {
   /*  if (! app()->isRunningUnitTests()) {
        return;
    } */
    Route::post('/factory', [LaravelPlaywrightController::class, 'factory'])->name('factory');
    Route::post('/login', [LaravelPlaywrightController::class, 'login'])->name('login');
    Route::post('/logout', [LaravelPlaywrightController::class, 'logout'])->name('logout');
    Route::post('/artisan', [LaravelPlaywrightController::class, 'artisan'])->name('artisan');
    Route::post('/run-php', [LaravelPlaywrightController::class, 'runPhp'])->name('run-php');
    Route::get('/csrf_token', [LaravelPlaywrightController::class, 'csrfToken'])->name('csrf-token');
    Route::post('/routes', [LaravelPlaywrightController::class, 'routes'])->name('routes');
    Route::post('/current-user', [LaravelPlaywrightController::class, 'currentUser'])->name('current-user');
});
