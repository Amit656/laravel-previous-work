<?php

namespace Modules\Location\Tests\Unit;

use Modules\Location\App\Models\Location;
use Modules\Location\App\Repositories\LocationRepository;
use Tests\TestCase;

class LocationUnitTest extends TestCase
{
    private LocationRepository $locationRepository;

    private $fakePayloadData;

    private $threePlId = 1;

    public function setup(): void
    {
        parent::setup();
        $locationFactory = Location::factory()->create();
        $this->threePlId = $locationFactory->three_pl_id;
        $this->userId = rand(1, 100);
        $this->fakePayloadData = [
            'location_type_id' => $locationFactory->location_type_id,
            'warehouse_id' => $locationFactory->warehouse_id,
            'name' => $locationFactory->name,
            'is_pickable' => $locationFactory->is_pickable,
            'is_sellable' => $locationFactory->is_sellable,
            'barcode' => $locationFactory->barcode,
        ];

        $this->locationRepository = new LocationRepository(new Location);
    }

    /**
     * to test create a location
     *
     * @return void
     */
    public function test_location_store()
    {
        $payload = $this->fakePayloadData;
        $locationType = $this->locationRepository->store($this->threePlId, $this->userId, $payload);

        $actual = [
            'location_type_id' => $locationType->location_type_id,
            'warehouse_id' => $locationType->warehouse_id,
            'name' => $locationType->name,
            'is_pickable' => $locationType->is_pickable,
            'is_sellable' => $locationType->is_sellable,
            'barcode' => $locationType->barcode,
        ];

        $expected = $payload;
        $this->assertEquals($actual, $expected);
    }

    /**
     * Test delete location
     *
     * @return void
     */
    public function test_delete_location()
    {
        $location = Location::factory()->create();
        $deleteLocation = $this->locationRepository->deleteBy('id', $location->id);
        $location->refresh();
        $this->assertTrue($deleteLocation == true);
    }
}
