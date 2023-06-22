<?php

namespace Modules\Product;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ProductEventServiceProvider extends ServiceProvider
{
    protected $listen = [
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
