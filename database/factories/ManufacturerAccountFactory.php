<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ManufacturerAccount;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ManufacturerAccount>
 */
class ManufacturerAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ManufacturerAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,100),
            'manufacturer_id' => rand(1,10)
        ];
    }
}
