<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\App\Controllers\ProductController;
use Modules\Product\App\Controllers\VendorProductController;

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
    Route::resource('products', ProductController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

    Route::prefix('products')->group(function () {
        Route::get('/search/{vendorId}', [ProductController::class, 'searchProductsForVendor']);
    });

    Route::prefix('vendor/products')->group(function () {
        Route::get('/{vendorId}', [VendorProductController::class, 'getVendorProduct']);
        Route::delete('delete-vendor-product', [VendorProductController::class, 'deleteVendorProduct']);
        Route::put('update/{productVendorId}', [VendorProductController::class, 'updateVendorProduct']);
        Route::post('assign', [VendorProductController::class, 'assignProductToVendor']);
    });

    Route::get('product/vendors/{product}', [VendorProductController::class, 'getProductVendors']);
});
