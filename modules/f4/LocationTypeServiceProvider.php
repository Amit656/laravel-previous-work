<?php

namespace Modules\Locationtype;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\Locationtype\App\Repositories\LocationTypeRepository;
use Modules\Locationtype\App\Repositories\LocationTypeRepositoryInterface;

class LocationTypeServiceProvider extends BaseServiceProvider
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
        $this->loadTranslationsFrom(__DIR__.'/lang', 'locationType');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LocationTypeRepositoryInterface::class, LocationTypeRepository::class);
    }
}
