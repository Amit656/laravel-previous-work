<?php

namespace Modules\Warehouse;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Warehouse\App\Events\WarehouseCreatedEvent;
use Modules\Warehouse\App\Listeners\WarehouseCreatedListener;

class WarehouseEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        WarehouseCreatedEvent::class => [
            WarehouseCreatedListener::class,
        ],
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
