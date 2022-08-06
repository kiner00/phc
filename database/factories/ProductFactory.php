<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'manufacturer_id' => rand(1,2),
            'product_category_id' => rand(4,5),
            'created_by' => rand(1,10),
            'base_price' => rand(100,350),
            'stocks' => 0
        ];
    }
}
