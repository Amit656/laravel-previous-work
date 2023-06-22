<?php

namespace Modules\Warehouse\Tests\Feature;

use Faker\Factory;
use Illuminate\Http\Response;
use Modules\Warehouse\App\Models\Warehouse;
use Tests\TestCase;

class WarehouseFeatureTest extends TestCase
{
    private $fakePayloadData;

    private $threePlId;

    public function setup(): void
    {
        parent::setup();
        $faker = Factory::create('en_US');
        $this->threePlId = Warehouse::first()->three_pl_id ?? $faker->numberBetween(0, 100);
        $this->fakePayloadData = [
            'name' => $faker->name(),
            'latitude' => $faker->latitude($min = -90, $max = 90),
            'longitude' => $faker->longitude($min = -180, $max = 180),
            'address' => $faker->address,
            'pin_code' => $faker->postcode,
            'city' => $faker->city,
            'province' => $faker->state,
            'country' => 2,
            'threshold_settings' => [
                'sku' => 1,
                'orders' => 1,
                'stores' => 1,
                'three_pl_customers' => 1,
            ],
        ];
    }

    /**
     * to test create a warehouse
     *
     * @return void
     */
    public function test_create_warehouse()
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/warehouses/', $this->fakePayloadData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'created_at',
                    'ulid',
                    'latitude',
                    'longitude',
                    'address',
                    'pin_code',
                    'city',
                    'province',
                    'country',
                    'threshold_settings' => [
                        'three_pl_customers',
                        'sku',
                        'orders',
                        'stores',
                    ],
                ],
                'metadata' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => $this->fakePayloadData,
                'metadata' => [
                    'message' => 'Warehouse has been added successfully.',
                ],

            ]);
    }

    /**
     * to test create a warehouse
     *
     * @return void
     */
    public function test_edit_warehouse()
    {
        $payload = $this->fakePayloadData;
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/warehouses', $payload);

        $warehouse = $response->json();

        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->getJson('/api/'.$this->threePlId.'/warehouses/'.$warehouse['data']['ulid']);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'ulid',
                    'latitude',
                    'longitude',
                    'address',
                    'pin_code',
                    'city',
                    'province',
                    'country',
                    'threshold_settings' => [
                        'three_pl_customers',
                        'sku',
                        'orders',
                        'stores',
                    ],
                ],
                'metadata' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => $payload,
                'metadata' => [
                    'message' => 'Warehouse has been showed successfully.',
                ],

            ]);
    }

    /**
     * to test create a warehouse
     *
     * @return void
     */
    public function test_update_warehouse()
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/warehouses/', $this->fakePayloadData);

        $warehouse = $response->json();
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->putJson('/api/'.$this->threePlId.'/warehouses/'.$warehouse['data']['ulid'], $this->fakePayloadData);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'ulid',
                    'latitude',
                    'longitude',
                    'address',
                    'pin_code',
                    'city',
                    'province',
                    'country',
                    'threshold_settings' => [
                        'three_pl_customers',
                        'sku',
                        'orders',
                        'stores',
                    ],
                ],
                'metadata' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => $this->fakePayloadData,
                'metadata' => [
                    'message' => 'Warehouse has been updated successfully.',
                ],

            ]);
    }

    /**
     * to test all warehouses
     *
     * @return void
     */
    public function test_get_all_warehouses()
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->getJson('/api/'.$this->threePlId.'/warehouses/');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'data',
                    'current_page',
                    'first_page_url',
                    'next_page_url',
                    'per_page',
                    'prev_page_url',
                ],
                'metadata' => [
                    'message',
                ],
            ]);
    }

     /**
      * to test get all warehouses
      *
      * @return void
      */
     public function test_all_warehouses()
     {
         $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
             ->getJson('/api/'.$this->threePlId.'/list/warehouses');

         $response->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure([
                 'data' => [
                     [
                         'ulid',
                         'name',
                     ],
                 ],
                 'metadata' => [
                     'message',
                 ],
             ]);
     }

    /**
     * to test warehouse exists
     *
     * @return bool
     */
    public function test_warehouse_exists()
    {
        $payload = $this->fakePayloadData;
        $warehouseIDs = ['_st_MQ==', '_st_Mg=='];

        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->getJson('/api/warehouses/check-exists', $warehouseIDs);

        $response->assertTrue($response);
    }
}
