<?php

namespace Modules\Product\Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Modules\Product\App\Models\Product;
use StallionExpress\AuthUtility\Models\User;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
    // use WithoutMiddleware;
    private $fakePayloadData;

    private $faker;

    private $authUser;

    public function setup(): void
    {
        parent::setup();
        $threePlCustomer = User::where('email', 'three-pl-seeder@seeder.com')->first();
        $this->authUser = $threePlCustomer;
        $this->authUser->abilities = ['product' => ['create', 'list', 'update', 'delete', 'edit']];
        $this->authUser->three_pl = User::where('email', 'three-pl-seeder@seeder.com')->first();
        $this->authUser->three_pl_customer = $threePlCustomer;
        $this->faker = Factory::create('en_US');

        $this->fakePayloadData = [
            'three_pl_customer_id' => '1',
            'warehouse_id' => '1',
            'name' => $this->faker->name,
            'is_kit' => $this->faker->boolean(),
            'value' => $this->faker->randomFloat(2, 0, 99999999.99),
            'weight' => $this->faker->randomFloat(2, 0, 99999999.99),
            'sku' => $this->faker->word(),
            'barcode' => (string) $this->faker->numberBetween(100000000000, 999999999999),
            'vendors' => [
                '1',
            ],
            'images' => [
            ],
        ];
    }

    /**
     * to test create a Product
     *
     * @return void
     */
    public function test_create_product()
    {
        $response = $this->actingAs($this->authUser)
            ->postJson('/api/products', $this->fakePayloadData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                ],
                'metadata' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => [
                ],
                'metadata' => [
                    'message' => 'Product has been added successfully.',
                ],
            ]);
    }

    /**
     * to test all Product
     *
     * @return void
     */
    public function test_get_all_products()
    {
        $response = $this->actingAs($this->authUser)
            ->getJson('/api/products');

        $response->assertStatus(Response::HTTP_OK)
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
     * to test edit threepl
     *
     * @return void
     */
    public function test_get_product_by_id()
    {
        $fakeData = $this->fakePayloadData;
        $response = $this->actingAs($this->authUser)
            ->postJson('/api/products', $fakeData);

        $product = Product::all()->last();

        $response = $this->actingAs($this->authUser)
            ->getJson('/api/products/'.$product->hash);

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertJsonStructure([
                'data' => [
                    'three_pl_customer_id',
                    'warehouse_id',
                    'name',
                    'is_kit',
                    'value',
                    'weight',
                    'sku',
                    'barcode',
                    'status',
                    'hash',
                    'images' => [],
                    'vendors' => [],
                ],
                'metadata' => [
                    'message',
                ],

            ])
            ->assertJson([
                'data' => [
                    'warehouse_id' => $fakeData['warehouse_id'],
                    'name' => $fakeData['name'],
                    'is_kit' => $fakeData['is_kit'],
                    'value' => $fakeData['value'],
                    'weight' => $fakeData['weight'],
                    'sku' => $fakeData['sku'],
                    'barcode' => $fakeData['barcode'],
                ],
                'metadata' => [
                    'message' => 'Product returned successfully.',
                ],
            ]);
    }

    /**
     * to test delete product
     *
     * @return void
     */
    public function test_delete_Product()
    {
        $fakeData = $this->fakePayloadData;
        $response = $this->actingAs($this->authUser)
            ->postJson('/api/products', $this->fakePayloadData);

        $product = Product::all()->last();

        $response = $this->actingAs($this->authUser)
            ->deleteJson('/api/products/'.$product->hash);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data',
                'metadata' => [
                    'message',
                ],
            ])->assertJson([
                'metadata' => [
                    'message' => 'Product deleted successfully.',
                ],
            ]);
    }

    /**
     * to test update product
     *
     * @return void
     */
    public function test_update_product()
    {
        $response = $this->actingAs($this->authUser)
            ->postJson('/api/products', $this->fakePayloadData);

        $product = Product::all()->last();

        $updateFakeData = [
            'three_pl_customer_id' => '_st_Mg==',
            'warehouse_id' => '_st_Mg==',
            'name' => $this->faker->name,
            'is_kit' => $this->faker->boolean(),
            'value' => $this->faker->randomFloat(2, 0, 99999999.99),
            'weight' => $this->faker->randomFloat(2, 0, 99999999.99),
            'sku' => $this->faker->word(),
            'status' => $this->faker->boolean(),
            'barcode' => (string) $this->faker->numberBetween(100000000000, 999999999999),
            'vendors' => [
                '_st_Mg==',
            ],
            'images' => [

            ],
        ];

        $response = $this->actingAs($this->authUser)
            ->putJson('/api/products/'.$product->hash, $updateFakeData);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                ],
                'metadata' => [
                    'message',
                ],

            ])
            ->assertJson([
                'data' => [
                ],
                'metadata' => [
                    'message' => 'Product updated successfully.',
                ],
            ]);
    }

    /**
     * to test update product
     *
     * @return void
     */
    public function test_get_vendors_by_product()
    {
        $response = $this->actingAs($this->authUser)
            ->postJson('/api/products', $this->fakePayloadData);

        $product = Product::all()->last();

        $response = $this->actingAs($this->authUser)
            ->getJson('/api/product/vendors/'.$product->hash);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'price',
                    'manufacturer_sku',
                    'hash',
                    'details' => [
                        'name',
                        'email',
                        'account_number',
                        'internal_note',
                        'po_note',
                        'address_one',
                        'city',
                        'zip_code',
                        'country',
                        'state',
                        'currency',
                        'hash',
                    ],
                ],
                'metadata' => [
                    'message',
                ],

            ])
            ->assertJson([
                'data' => [
                ],
                'metadata' => [
                    'message' => 'Vendor returned successfully.',
                ],
            ]);
    }
}
