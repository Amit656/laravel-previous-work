<?php

namespace Modules\Product\Tests\Unit;

use Faker\Factory;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Repositories\ProductRepository;
use StallionExpress\AuthUtility\Models\User;
use StallionExpress\AuthUtility\Trait\STEncodeDecodeTrait;
use Tests\TestCase;

class ProductUnitTest extends TestCase
{
    use STEncodeDecodeTrait;

    private ProductRepository $productRepository;

    private $fakePayloadData;

    private $faker;

    private $loggedUserId = 1;

    private $loggedUser;

    public function setup(): void
    {
        parent::setup();
        $threePlCustomer = User::where('email', 'three-pl-customer-seeder@seeder.com')->first();
        $this->loggedUser = $threePlCustomer;
        $this->loggedUser->three_pl = User::where('email', 'three-pl-seeder@seeder.com')->first();
        $this->loggedUser->three_pl_customer = $threePlCustomer;
        $this->faker = Factory::create('en_US');

        $this->fakePayloadData = [
            'three_pl_customer_id' => $this->loggedUser->three_pl_customer->id,
            'warehouse_id' => 1,
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

        $this->productRepository = new ProductRepository(new Product);
    }

    /**
     * A create Product.
     *
     * @return void
     */
    public function test_product_store()
    {
        $product = $this->productRepository->store($this->fakePayloadData, $this->loggedUser);
        $this->assertEquals(
            [
                'three_pl_customer_id' => $product->three_pl_customer_id,
                'warehouse_id' => $product->warehouse_id,
                'name' => $product->name,
                'is_kit' => $product->is_kit,
                'value' => $product->value,
                'weight' => $product->weight,
                'sku' => $product->sku,
                'barcode' => $product->barcode,

            ],
            [
                'three_pl_customer_id' => $this->encodeHashValue($this->fakePayloadData['three_pl_customer_id']),
                'warehouse_id' => $this->encodeHashValue($this->fakePayloadData['warehouse_id']),
                'name' => $this->fakePayloadData['name'],
                'is_kit' => $this->fakePayloadData['is_kit'],
                'value' => $this->fakePayloadData['value'],
                'weight' => $this->fakePayloadData['weight'],
                'sku' => $this->fakePayloadData['sku'],
                'barcode' => $this->fakePayloadData['barcode'],
            ]
        );
    }

    /**
     * Test get Product List.
     *
     * @return void
     */
    public function test_get_all_product()
    {
        $product = $this->productRepository->store($this->fakePayloadData, $this->loggedUser);

        $response = $this->productRepository->getByParams([
            ['id', $product->id],
        ]);

        $this->assertEquals(
            [
                'three_pl_customer_id' => $product->three_pl_customer_id,
                'warehouse_id' => $product->warehouse_id,
                'name' => $product->name,
                'is_kit' => $product->is_kit,
                'value' => $product->value,
                'weight' => $product->weight,
                'sku' => $product->sku,
                'barcode' => $product->barcode,

            ],
            [
                'three_pl_customer_id' => $this->encodeHashValue($this->fakePayloadData['three_pl_customer_id']),
                'warehouse_id' => $this->encodeHashValue($this->fakePayloadData['warehouse_id']),
                'name' => $this->fakePayloadData['name'],
                'is_kit' => $this->fakePayloadData['is_kit'],
                'value' => $this->fakePayloadData['value'],
                'weight' => $this->fakePayloadData['weight'],
                'sku' => $this->fakePayloadData['sku'],
                'barcode' => $this->fakePayloadData['barcode'],
            ]
        );
    }

    /**
     * Test update Product.
     *
     * @return void
     */
    public function test_update_product()
    {
        $product = $this->productRepository->store($this->fakePayloadData, $this->loggedUser);

        $updateFakeData = [
            'three_pl_customer_id' => '1',
            'warehouse_id' => '1',
            'name' => $this->faker->name,
            'is_kit' => $this->faker->boolean(),
            'value' => $this->faker->randomFloat(2, 0, 99999999.99),
            'weight' => $this->faker->randomFloat(2, 0, 99999999.99),
            'sku' => $this->faker->word(),
            'status' => $this->faker->boolean(),
            'barcode' => (string) $this->faker->numberBetween(100000000000, 999999999999),
            'vendors' => [
                '1',
            ],
            'images' => [
            ],
        ];

        $this->productRepository->update($product, $this->loggedUserId, $updateFakeData);

        $updatedProduct = $this->productRepository->getByParams([
            ['id', $product->id],
        ]);

        $updatedProduct->load(['images', 'vendors']);
        $this->assertEquals([
            'name' => $updateFakeData['name'],
            'is_kit' => $updateFakeData['is_kit'],
            'value' => $updateFakeData['value'],
            'sku' => $updateFakeData['sku'],
            'status' => $updateFakeData['status'],
            'barcode' => $updateFakeData['barcode'],
            'vendors' => $updateFakeData['vendors'],
        ], [
            'name' => $updatedProduct->name,
            'is_kit' => $updatedProduct->is_kit,
            'value' => $updatedProduct->value,
            'sku' => $updatedProduct->sku,
            'status' => $updatedProduct->status,
            'barcode' => $updatedProduct->barcode,
            'vendors' => $updatedProduct->vendors->pluck('vendor_id')->toArray(),
        ]);
    }

    /**
     * Test delete Product.
     *
     * @return void
     */
    public function test_delete_product()
    {
        $product = $this->productRepository->store($this->fakePayloadData, $this->loggedUser);
        $deleteProduct = $this->productRepository->delete($product, $this->loggedUserId);
        $this->assertTrue($deleteProduct);
    }
}
