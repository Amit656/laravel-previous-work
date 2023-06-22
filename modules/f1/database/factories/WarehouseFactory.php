<?php

namespace Modules\Warehouse\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Warehouse\App\Models\Warehouse;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ulid' => Str::ulid(),
            'three_pl_id' => fake()->numberBetween(0, 100),
            'name' => fake()->word().time(),
            'latitude' => fake()->latitude($min = -90, $max = 90),
            'longitude' => fake()->longitude($min = -180, $max = 180),
            'address' => fake()->address,
            'pin_code' => fake()->postcode,
            'city' => fake()->city,
            'province' => fake()->state,
            'country' => 2,
            'threshold_settings' => [
                'sku' => 1,
                'orders' => 1,
                'stores' => 1,
                'three_pl_customers' => 1,
            ],
        ];
    }
}
