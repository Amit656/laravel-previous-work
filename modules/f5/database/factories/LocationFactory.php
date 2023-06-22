<?php

namespace Modules\Location\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Location\App\Models\Location;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LocationFactory extends Factory
{
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'three_pl_id' => fake()->numberBetween(0, 100),
            'location_type_id' => fake()->numberBetween(0, 100),
            'warehouse_id' => fake()->numberBetween(0, 100),
            'name' => fake()->word(),
            'is_pickable' => fake()->numberBetween(0, 0),
            'is_sellable' => fake()->numberBetween(0, 0),
            'barcode' => fake()->numberBetween(100000, 999999),
            'last_modified_by' => fake()->numberBetween(0, 100),
        ];
    }
}
