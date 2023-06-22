<?php

namespace Modules\Vendor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Vendor\App\Models\Vendor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'three_pl_customer_id' => fake()->numberBetween(0, 100),
            'name' => fake()->word().time(),
            'email' => fake()->email,
            'account_number' => fake()->bankAccountNumber,
            'internal_note' => fake()->text,
            'po_note' => fake()->text,
            'address_one' => fake()->address,
            'address_two' => fake()->address,
            'city' => fake()->city,
            'zip_code' => fake()->postcode,
            'country' => fake()->numberBetween(0, 100),
            'state' => fake()->numberBetween(0, 100),
            'currency' => fake()->numberBetween(0, 100), 
            'last_modified_by' => fake()->numberBetween(0, 100),      
        ];
    }
}
