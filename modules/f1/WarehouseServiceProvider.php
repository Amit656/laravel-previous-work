<?php

namespace Modules\Warehouse;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Warehouse\App\Repositories\WarehouseRepository;
use Modules\Warehouse\App\Repositories\WarehouseRepositoryInterface;

class WarehouseServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(WarehouseEventServiceProvider::class);
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/v1/api.php');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'warehouse');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WarehouseRepositoryInterface::class, WarehouseRepository::class);
    }
}
