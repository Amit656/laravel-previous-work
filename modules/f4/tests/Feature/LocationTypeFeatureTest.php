<?php

namespace Modules\Locationtype\Tests\Feature;

use Illuminate\Http\Response;
use Modules\Locationtype\App\Models\LocationType;
use Tests\TestCase;

class LocationTypeFeatureTest extends TestCase
{
    private $fakePayloadData;

    private $threePlId;

    public function setup(): void
    {
        parent::setup();
        $locationTypeFactory = LocationType::factory()->create();
        //$this->threePlId = $locationTypeFactory->three_pl_id;
        $this->threePlId = rand(1, 100);

        $this->fakePayloadData = [
            'name' => $locationTypeFactory->name,
        ];
    }

    /**
     * to test create a location type
     *
     * @return void
     */
    public function test_create_location_type()
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/location-types/', $this->fakePayloadData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'three_pl_id',
                    'last_modified_by',
                    'updated_at',
                    'created_at',
                ],
                'metadata' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => $this->fakePayloadData,
                'metadata' => [
                    'message' => 'Location type added successfully',
                ],

            ]);
    }

    /**
     * to test Edit/Show a location type
     *
     * @return void
     */
    public function test_edit_location_type()
    {
        $payload = $this->fakePayloadData;
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/location-types', $payload);

        $locationType = $response->json();

        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->getJson('/api/'.$this->threePlId.'/location-types/'.$locationType['data']['id']);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertJsonStructure([
                'data' => [
                    'three_pl_id',
                    'name',
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
                    'message' => 'Location type showed successfully',
                ],
            ]);
    }

    /**
     * to test update location type
     *
     * @return void
     */
    public function test_update_location_type()
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/location-types/', $this->fakePayloadData);

        $locationType = $response->json();
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->putJson('/api/'.$this->threePlId.'/location-types/'.$locationType['data']['id'], $this->fakePayloadData);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'three_pl_id',
                    'name',
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
                'data' => $this->fakePayloadData,
                'metadata' => [
                    'message' => 'Location type updated successfully',
                ],

            ]);
    }

    /**
     * to test get all location types
     *
     * @return void
     */
    public function test_get_all_location_types()
    {
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->getJson('/api/'.$this->threePlId.'/location-types/');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'current_page',
                    'data',
                    'first_page_url',
                    'from',
                    'last_page',
                    'last_page_url',
                    'links',
                    'next_page_url',
                    'path',
                    'per_page',
                    'prev_page_url',
                    'to',
                    'total',
                ],
                'metadata' => [
                    'message',
                ],
            ]);
    }

    /**
     * to test delete location type
     *
     * @return void
     */
    public function test_delete_location_type()
    {
        $payload = $this->fakePayloadData;
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->postJson('/api/'.$this->threePlId.'/location-types', $payload);

        $locationType = $response->json();
        $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
            ->deleteJson('/api/'.$this->threePlId.'/location-types/'.$locationType['data']['id']);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data',
                'metadata' => [
                    'message',
                ],
            ])->assertJson([
                'metadata' => [
                    'message' => 'Location type deleted successfully',
                ],
            ]);
    }

     /**
      * to test get all location types
      *
      * @return void
      */
     public function test_all_location_types()
     {
         $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
             ->postJson('/api/'.$this->threePlId.'/location-types', $this->fakePayloadData);

         $response = $this->withoutMiddleware(\App\Http\Middleware\IsUserAuthorized::class)
             ->getJson('/api/'.$this->threePlId.'/all/location-types');

         $response->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure([
                 'data' => [
                     [
                         'id',
                         'name',
                     ],
                 ],
                 'metadata' => [
                     'message',
                 ],
             ]);
     }
}
