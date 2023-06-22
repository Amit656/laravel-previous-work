<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'three_pl_customer_id' => (int) fake()->numberBetween(1, 999999999999),
            'warehouse_id' => (int) fake()->numberBetween(1, 999999999999),
            'name' => fake()->name,
            'is_kit' => fake()->boolean(),
            'value' => fake()->randomFloat(2, 0, 99999999.99),
            'weight' => fake()->randomFloat(2, 0, 99999999.99),
            'sku' => fake()->word(),
            'status' => fake()->boolean(),
            'barcode' => (string) fake()->numberBetween(100000000000, 999999999999),
            'last_updated_by' => (int) fake()->numberBetween(1, 999999999999),
        ];
    }
}
