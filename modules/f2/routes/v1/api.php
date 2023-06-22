<?php

use Illuminate\Support\Facades\Route;
use Modules\Vendor\App\Controllers\VendorController;

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
    Route::post('vendors/exists', [VendorController::class, 'checkVendorExists']);
});

Route::prefix('api')->middleware(['api', 'auth:token'])->group(function () {
    Route::get('3pl-customer/vendors', [VendorController::class, 'getVendorsBy3plCustomers']);
    Route::post('vendors/exists', [VendorController::class, 'checkVendorExists']);
    Route::resource('vendors', VendorController::class);
});
