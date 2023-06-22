<?php

namespace Modules\Locationtype\Tests\Unit;

use Modules\Locationtype\App\Models\LocationType;
use Modules\Locationtype\App\Repositories\LocationTypeRepository;
use Tests\TestCase;

class LocationTypeUnitTest extends TestCase
{
    private LocationTypeRepository $locationTypeRepository;

    private $fakePayloadData;

    private $threePlId = 1;

    private $userId = 1;

    public function setup(): void
    {
        parent::setup();
        $locationTypeFactory = LocationType::factory()->create();
        $this->threePlId = $locationTypeFactory->three_pl_id;
        $this->userId = 1;
        $this->fakePayloadData = [
            'name' => $locationTypeFactory->name,
        ];

        $this->locationTypeRepository = new LocationTypeRepository(new LocationType);
    }

    /**
     * to test create a location type
     *
     * @return void
     */
    public function test_location_type_store()
    {
        $payload = $this->fakePayloadData;
        $locationType = $this->locationTypeRepository->store($this->threePlId, $this->userId, $payload);

        $actual = [
            'name' => $locationType->name,
        ];

        $expected = $payload;
        $this->assertEquals($actual, $expected);
    }

    /**
     * to test get all location types
     *
     * @return void
     */
    public function test_get_all_location_types()
    {
        $locationType = $this->locationTypeRepository->store($this->threePlId, $this->userId, $this->fakePayloadData);
        $actual = [
            'name' => $locationType->name,
        ];

        $lastLocationType = $this->locationTypeRepository->getBy('id', $locationType->id);
        $expected = [
            'name' => $lastLocationType->name,
        ];
        $this->assertEquals($actual, $expected);
    }

    /**
     * to test Edit/Show a location type
     *
     * @return void
     */
    public function test_show_location_type()
    {
        $locationType = $this->locationTypeRepository->store($this->threePlId, $this->userId, $this->fakePayloadData);

        $actual = [
            'name' => $locationType->name,
        ];

        $lastLocationType = $this->locationTypeRepository->getByParams([
            ['id', $locationType->id],
            ['three_pl_id', $locationType->three_pl_id],
        ]);
        $expected = [
            'name' => $lastLocationType->name,
        ];
        $this->assertEquals($actual, $expected);
    }

    /**
     * to test update location type
     *
     * @return void
     */
    public function test_update_location_type()
    {
        $locationType = $this->locationTypeRepository->store($this->threePlId, $this->userId, $this->fakePayloadData);

        $actual = [
            'name' => $locationType->name,
        ];

        $lastLocationType = $this->locationTypeRepository->update($locationType, $locationType->three_pl_id, $this->userId, $this->fakePayloadData);
        $expected = [
            'name' => $lastLocationType->name,
        ];
        $this->assertEquals($actual, $expected);
    }

    /**
     * Test delete location type
     *
     * @return void
     */
    public function test_delete_location_type()
    {
        $locationType = $this->locationTypeRepository->store($this->threePlId, $this->userId, $this->fakePayloadData);
        $deleteLocationType = $this->locationTypeRepository->deleteBy('id', $locationType->id);
        $this->assertTrue($deleteLocationType == true);
    }

    /**
     * Test get location types by name
     *
     * @return void
     */
    public function test_all_location_types()
    {
        $locationType = $this->locationTypeRepository->store($this->threePlId, $this->userId, $this->fakePayloadData);
        $actual = [
            'name' => $locationType->name,
        ];

        $allLocationTypes = $this->locationTypeRepository->locationTypes($this->threePlId);
        $getCreatedlocationType = $allLocationTypes->where('name', $locationType->name)->first();
        $expected = [
            'name' => $getCreatedlocationType->name,
        ];
        $this->assertEquals($actual, $expected);
    }
}
