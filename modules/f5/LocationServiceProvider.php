<?php

namespace Modules\Location;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Location\App\Repositories\LocationRepository;
use Modules\Location\App\Repositories\LocationRepositoryInterface;

class LocationServiceProvider extends BaseServiceProvider
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
        $this->loadTranslationsFrom(__DIR__.'/lang', 'location');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
    }
}
