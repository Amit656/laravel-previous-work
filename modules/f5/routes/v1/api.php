<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\App\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('api')->middleware(['api', 'auth:token'])->group(function () {
    Route::resource('locations', LocationController::class)->only([
        'index', 'store', 'show', 'update', 'destroy',
    ]);

    Route::get('locations/show-barcode/{location}', [LocationController::class, 'showLocationBarcode']);
});
