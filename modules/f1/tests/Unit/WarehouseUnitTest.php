<?php

namespace Modules\Warehouse\Tests\Unit;

use Modules\Warehouse\App\Models\Warehouse;
use Modules\Warehouse\App\Repositories\WarehouseRepository;
use Tests\TestCase;

class WarehouseUnitTest extends TestCase
{
    private WarehouseRepository $warehouseRepository;

    private $fakePayloadData;

    private $threePlId = 1;

    public function setup(): void
    {
        parent::setup();
        $warehouseFactory = Warehouse::factory()->create();
        $this->threePlId = $warehouseFactory->three_pl_id;
        $this->fakePayloadData = [
            'name' => $warehouseFactory->name,
            'latitude' => $warehouseFactory->latitude,
            'longitude' => $warehouseFactory->longitude,
            'address' => $warehouseFactory->address,
            'pin_code' => $warehouseFactory->pin_code,
            'city' => $warehouseFactory->city,
            'province' => $warehouseFactory->province,
            'country' => $warehouseFactory->country,
            'threshold_settings' => $warehouseFactory->threshold_settings,
        ];

        $this->warehouseRepository = new WarehouseRepository(new Warehouse);
    }

    /**
     * A create warehouse.
     *
     * @return void
     */
    public function test_warehouse_store()
    {
        $payload = $this->fakePayloadData;
        $warehouse = $this->warehouseRepository->store($this->threePlId, $payload);

        $actual = [
            'name' => $warehouse->name,
            'latitude' => $warehouse->latitude,
            'longitude' => $warehouse->longitude,
            'address' => $warehouse->address,
            'pin_code' => $warehouse->pin_code,
            'city' => $warehouse->city,
            'country' => $warehouse->country,
            'province' => $warehouse->province,
            'threshold_settings' => $warehouse->threshold_settings,
        ];

        $expected = $payload;
        $this->assertEquals($actual, $expected);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_all_warehouses()
    {
        $warehouse = $this->warehouseRepository->store($this->threePlId, $this->fakePayloadData);
        $actual = [
            'name' => $warehouse->name,
            'latitude' => $warehouse->latitude,
            'longitude' => $warehouse->longitude,
            'address' => $warehouse->address,
            'pin_code' => $warehouse->pin_code,
            'city' => $warehouse->city,
            'province' => $warehouse->province,
            'threshold_settings' => $warehouse->threshold_settings,
        ];

        $lastWarehouse = $this->warehouseRepository->getBy('ulid', $warehouse->ulid);
        $expected = [
            'name' => $lastWarehouse->name,
            'latitude' => $lastWarehouse->latitude,
            'longitude' => $lastWarehouse->longitude,
            'address' => $lastWarehouse->address,
            'pin_code' => $lastWarehouse->pin_code,
            'city' => $lastWarehouse->city,
            'province' => $lastWarehouse->province,
            'threshold_settings' => $lastWarehouse->threshold_settings,
        ];
        $this->assertEquals($actual, $expected);
    }

    /**
     * A show warehouse.
     *
     * @return void
     */
    public function test_show_warehouse()
    {
        $warehouse = $this->warehouseRepository->store($this->threePlId, $this->fakePayloadData);

        $actual = [
            'name' => $warehouse->name,
            'latitude' => $warehouse->latitude,
            'longitude' => $warehouse->longitude,
            'address' => $warehouse->address,
            'pin_code' => $warehouse->pin_code,
            'city' => $warehouse->city,
            'province' => $warehouse->province,
            'threshold_settings' => $warehouse->threshold_settings,
        ];

        $lastWarehouse = $this->warehouseRepository->getByParams([
            ['ulid', $warehouse->ulid],
            ['three_pl_id', $warehouse->three_pl_id],
        ]);

        $expected = [
            'name' => $lastWarehouse->name,
            'latitude' => $lastWarehouse->latitude,
            'longitude' => $lastWarehouse->longitude,
            'address' => $lastWarehouse->address,
            'pin_code' => $lastWarehouse->pin_code,
            'city' => $lastWarehouse->city,
            'province' => $lastWarehouse->province,
            'threshold_settings' => $lastWarehouse->threshold_settings,
        ];
        $this->assertEquals($actual, $expected);
    }

    /**
     * Update a warehouse.
     *
     * @return void
     */
    public function test_update_warehouse()
    {
        $warehouse = $this->warehouseRepository->store($this->threePlId, $this->fakePayloadData);

        $actual = [
            'name' => $warehouse->name,
            'latitude' => $warehouse->latitude,
            'longitude' => $warehouse->longitude,
            'address' => $warehouse->address,
            'pin_code' => $warehouse->pin_code,
            'city' => $warehouse->city,
            'province' => $warehouse->province,
            'threshold_settings' => $warehouse->threshold_settings,
        ];

        $lastWarehouse = $this->warehouseRepository->update($warehouse, $warehouse->three_pl_id, $this->fakePayloadData);
        $expected = [
            'name' => $lastWarehouse->name,
            'latitude' => $lastWarehouse->latitude,
            'longitude' => $lastWarehouse->longitude,
            'address' => $lastWarehouse->address,
            'pin_code' => $lastWarehouse->pin_code,
            'city' => $lastWarehouse->city,
            'province' => $lastWarehouse->province,
            'threshold_settings' => $lastWarehouse->threshold_settings,
        ];
        $this->assertEquals($actual, $expected);
    }

    /**
     * Test get warehouses by name
     *
     * @return void
     */
    public function test_get_all_warehouses()
    {
        $warehouse = $this->warehouseRepository->store($this->threePlId, $this->fakePayloadData);
        $actual = [
            'name' => $warehouse->name,
        ];

        $allWarehouses = $this->warehouseRepository->warehouses($this->threePlId);
        $getCreatedWarehouse = $allWarehouses->where('name', $warehouse->name)->first();
        $expected = [
            'name' => $getCreatedWarehouse->name,
        ];
        $this->assertEquals($actual, $expected);
    }

    /**
     * to test check warehouse exists
     *
     * @return void
     */
    public function test_vendor_exists()
    {
        $warehouse = $this->warehouseRepository->store($this->threePlId, $this->fakePayloadData);
        $checkWarehouse = $this->warehouseRepository->warehouseExists($warehouse->id);
        $this->assertTrue($checkWarehouse == true);
    }
}
