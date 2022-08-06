<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'purchase_order_number' => fake()->postcode(),
            'manufacturer_id' => rand(1,2),
            'date_of_purchase_order' => now(),
            'date_needed' => now(),
            'status' => "Pending",
            'total_cost' => rand(1000,20000),
            'remaining_balance' => 0,
        ];
    }
}
