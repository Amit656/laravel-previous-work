<?php

namespace Modules\Locationtype\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Locationtype\App\Models\LocationType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LocationTypeFactory extends Factory
{
    protected $model = LocationType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'three_pl_id' => fake()->numberBetween(0, 100),
            'name' => fake()->word(),
            'last_modified_by' => fake()->numberBetween(0, 100),
        ];
    }
}
