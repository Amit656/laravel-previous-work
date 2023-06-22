<?php

use Illuminate\Support\Facades\Route;
use Modules\Warehouse\App\Controllers\WarehouseController;

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

Route::prefix('api/brain')->middleware(['api'])->group(function () {
    Route::post('warehouses/exists', [WarehouseController::class, 'checkWarehouseExists']);
});

Route::get('api/{threePlId}/warehouses/list', [WarehouseController::class, 'get3plWarehouses'])
    ->middleware('api');

Route::post('api/{threeCustomerId}/warehouses/attach', [WarehouseController::class, 'attachCustomerWarehouses'])
    ->middleware('api');

Route::prefix('api/{threePlId}')->middleware(['api'])->group(function () {
    Route::resource('warehouses', WarehouseController::class)->only([
        'index', 'store', 'show', 'update',
    ]);
});

Route::prefix('api')->middleware(['api', 'auth:token'])->group(function () {
    Route::get('warehouses/list/{threeCustomer?}', [WarehouseController::class, 'getWarehouses']);
    Route::post('warehouses/exists', [WarehouseController::class, 'checkWarehouseExists']);
});
