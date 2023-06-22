<?php

namespace Modules\Vendor\Tests\Feature\Vendor;

use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Vendor\App\Models\Vendor;

class VendorFeatureTest extends TestCase
{
    private $fakePayloadData;

    private $bearerToken;

    public function setup(): void
    {
        parent::setup();
        $vendorFactory = Vendor::factory()->create();

        $this->fakePayloadData = [
            'name' => $vendorFactory->name,
            'email' => $vendorFactory->email,
            'account_number' => $vendorFactory->account_number,
            'internal_note' => $vendorFactory->internal_note,
            'po_note' => $vendorFactory->po_note,
            'address_one' => $vendorFactory->address_one,
            'address_two' => $vendorFactory->address_two,
            'city' => $vendorFactory->city,
            'zip_code' => $vendorFactory->zip_code,
            'country' => $vendorFactory->country,
            'state' => $vendorFactory->state,
            'currency' => $vendorFactory->currency,
        ];

        //Commented for future
        // $loginResponse = $this->postJson('api/login', [
        //     'email' => 'admin@stallion.com',
        //     'password' => '12345678',
        // ]);

        // $loggedUser = $loginResponse->json();
        // $this->bearerToken = $loggedUser['data']['token'];
        $this->bearerToken = 'dummy-bearer';
    }

    /**
     * to test create a vendor
     *
     * @return void
     */
    public function test_create_vendor()
    {
        $response = $this->withHeader('Authorization', 'Bearer '.$this->bearerToken)
            ->postJson('/api/vendors/', $this->fakePayloadData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [                   
                    'name',
                    'email',
                    'account_number',
                    'internal_note',
                    'po_note',
                    'city',
                    'zip_code',
                    'country',
                    'state',
                    'currency',
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
                    'message' => 'Vendor added successfully',
                ],

            ]);
    }

    /**
     * to test get all vendors
     *
     * @return void
     */
    public function test_get_all_vendors()
    {
          $response = $this->withHeader('Authorization', 'Bearer '.$this->bearerToken)
              ->getJson('/api/vendors');
 
          $response->assertStatus(Response::HTTP_OK)
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
                    'total'
                  ],
                  'metadata' => [
                      'message',
                  ],
              ]);
    }

    /**
     * to test Edit/Show a vendor
     *
     * @return void
     */
    public function test_show_vendor()
    {
        $payload = $this->fakePayloadData;
        $response = $this->withHeader('Authorization', 'Bearer '.$this->bearerToken)
            ->postJson('/api/vendors', $payload);

        $vendor = $response->json();
        $response = $this->withHeader('Authorization', 'Bearer '.$this->bearerToken)
            ->getJson('/api/vendors/'.$vendor['data']['id']);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'account_number',
                    'internal_note',
                    'po_note',
                    'address_one',
                    'address_two',
                    'city',
                    'zip_code',
                    'country',
                    'state',
                    'currency',                   
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
                    'message' => 'Vendor showed successfully',
                ],
            ]);
    }

    /**
     * to test update vendor
     *
     * @return void
     */
    public function test_update_vendor()
    {
        $response = $this->withHeader('Authorization', 'Bearer '.$this->bearerToken)
            ->postJson('/api/vendors/', $this->fakePayloadData);

        $vendor = $response->json();
        $response = $this->withHeader('Authorization', 'Bearer '.$this->bearerToken)
            ->putJson('/api/vendors/'.$vendor['data']['id'], $this->fakePayloadData);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'account_number',
                    'internal_note',
                    'po_note',
                    'address_one',
                    'address_two',
                    'city',
                    'zip_code',
                    'country',
                    'state',
                    'currency',                   
                    'last_modified_by',                   
                ],
                'metadata' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => $this->fakePayloadData,
                'metadata' => [
                    'message' => 'Vendor updated successfully',
                ],

            ]);
    }

    /**
     * to test delete vendor
     *
     * @return void
     */
    public function test_delete_vendor()
    {
        $payload = $this->fakePayloadData;
        $response = $this->withHeader('Authorization', 'Bearer '.$this->bearerToken)
            ->postJson('/api/vendors', $payload);

        $vendor = $response->json();
        $response = $this->withHeader('Authorization', 'Bearer '.$this->bearerToken)
            ->deleteJson('/api/vendors/'.$vendor['data']['id']);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data',
                'metadata' => [
                    'message',
                ],
            ])->assertJson([
                'metadata' => [
                    'message' => 'Vendor deleted successfully',
                ],
            ]);
    }

    /**
     * Test get vendors by 3pl customer id
     *
     * @return void
     */
    public function test_get_vendors_by_3pl_customer()
    {
          $response = $this->getJson('/api/3pl-customer/vendors');
 
          $response->assertStatus(Response::HTTP_OK)
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
                    'total'
                  ],
                  'metadata' => [
                      'message',
                  ],
              ]);
    }

     /**
     * Test get products by vendor
     *
     * @return void
     */
    public function test_get_products_by_vendor()
    {
          $response = $this->getJson('/api/vendor-products');
 
          $response->assertStatus(Response::HTTP_OK)
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
                    'total'
                  ],
                  'metadata' => [
                      'message',
                  ],
              ]);
    }


}
