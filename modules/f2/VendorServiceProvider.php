<?php

namespace Modules\Vendor;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Vendor\App\Repositories\VendorRepository;
use Modules\Vendor\App\Repositories\VendorRepositoryInterface;

class VendorServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/v1/api.php');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'vendor');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VendorRepositoryInterface::class, VendorRepository::class);
    }
}
