<?php

namespace Modules\Warehouse\App\Listeners;

use Illuminate\Support\Facades\Auth;
use Modules\Location\App\Repositories\LocationRepositoryInterface;
use Modules\Locationtype\App\Repositories\LocationTypeRepositoryInterface;
use Modules\Warehouse\App\Events\WarehouseCreatedEvent;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;

class WarehouseCreatedListener
{
    use STEncodeDecodeTrait;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WarehouseCreatedEvent $event): void
    {
        $locationType = $this->createDefaultLocationType($event->warehouse);

        $this->createDefaultLocation($event->warehouse, $locationType);
    }

    private function createDefaultLocationType($warehouse)
    {
        $loggedInUser = (Auth::check()) ? Auth::user()->id : 1;

        return app(LocationTypeRepositoryInterface::class)->store($this->decodeHashValue($warehouse->three_pl_id), $loggedInUser, [
            'name' => 'Default',
        ]);
    }

    private function createDefaultLocation($warehouse, $locationType)
    {
        $loggedInUser = (Auth::check()) ? Auth::user()->id : 1;

        return app(LocationRepositoryInterface::class)->store($this->decodeHashValue($warehouse->three_pl_id), $loggedInUser, [
            'name' => 'Default',
            'location_type_id' => $locationType->id,
            'warehouse_id' => $warehouse->id,
        ]);
    }
}
