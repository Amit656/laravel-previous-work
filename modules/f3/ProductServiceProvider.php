<?php

namespace Modules\Product;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Product\App\Repositories\ProductImageInterface;
use Modules\Product\App\Repositories\ProductImageRepository;
use Modules\Product\App\Repositories\ProductRepository;
use Modules\Product\App\Repositories\ProductRepositoryInterface;
use Modules\Product\App\Repositories\ProductVendorInterface;
use Modules\Product\App\Repositories\ProductVendorRepository;

class ProductServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ProductEventServiceProvider::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductImageInterface::class, ProductImageRepository::class);
        $this->app->bind(ProductVendorInterface::class, ProductVendorRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/v1/api.php');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'product');
    }
}
