<?php

namespace Modules\Location\Tests\Feature;

use Illuminate\Http\Response;
use Modules\Location\App\Models\Location;
use Tests\TestCase;

class LocationFeatureTest extends TestCase
{
    private $fakePayloadData;

    private $threePlId;

    public function setup(): void
    {
        parent::setup();
        $locationFactory = Location::factory()->create();
        $this->threePlId = rand(1, 100);

        $this->fakePayloadData = [
            'location_type_id' => $locationFactory->location_type_id,
            'warehouse_id' => $locationFactory->warehouse_id,
            'name' => $locationFactory->name,
            'is_pickable' => $locationFactory->is_pickable,
            'is_sellable' => $locationFactory->is_sellable,
            'barcode' => $locationFactory->barcode,
        ];
    }

    /**
     * to test create location
     *
     * @return void
     */
    public function test_create_location()
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/locations/', $this->fakePayloadData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'location_type_id',
                    'warehouse_id',
                    'name',
                    'is_pickable',
                    'is_sellable',
                    'barcode',
                    'three_pl_id',
                    'last_modified_by',
                    'created_at',
                ],
                'metadata' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => $this->fakePayloadData,
                'metadata' => [
                    'message' => 'Location added successfully',
                ],

            ]);
    }

    /**
     * to test Edit/Show a location
     *
     * @return void
     */
    public function test_show_location()
    {
        $payload = $this->fakePayloadData;
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/locations', $payload);

        $location = $response->json();

        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->getJson('/api/'.$this->threePlId.'/locations/'.$location['data']['id']);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertJsonStructure([
                'data' => [
                    'three_pl_id',
                    'location_type_id',
                    'warehouse_id',
                    'name',
                    'is_pickable',
                    'is_sellable',
                    'barcode',
                    'last_modified_by',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
                'metadata' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => $payload,
                'metadata' => [
                    'message' => 'Location showed successfully',
                ],
            ]);
    }

    /**
     * to test update location
     *
     * @return void
     */
    public function test_update_location()
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/locations/', $this->fakePayloadData);

        $location = $response->json();
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->putJson('/api/'.$this->threePlId.'/locations/'.$location['data']['id'], $this->fakePayloadData);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'three_pl_id',
                    'location_type_id',
                    'warehouse_id',
                    'name',
                    'is_pickable',
                    'is_sellable',
                    'barcode',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    'last_modified_by',
                ],
                'metadata' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => $this->fakePayloadData,
                'metadata' => [
                    'message' => 'Location updated successfully',
                ],

            ]);
    }

    /**
     * to test delete location
     *
     * @return void
     */
    public function test_delete_location()
    {
        $payload = $this->fakePayloadData;
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/locations', $payload);

        $location = $response->json();
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->deleteJson('/api/'.$this->threePlId.'/locations/'.$location['data']['id']);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data',
                'metadata' => [
                    'message',
                ],
            ])->assertJson([
                'metadata' => [
                    'message' => 'Location deleted successfully',
                ],
            ]);
    }
}
