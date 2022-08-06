<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(99)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Manufacturer::factory()->create([
            'name' => 'Manufacturer 1',
        ]);

        \App\Models\ProductCategory::factory()->create([
            'name' => 'Product Category 1',
        ]);

        \App\Models\Product::factory()->create([
            'manufacturer_id' => 1,
            'product_category_id' => 1,
            'name' => 'Product 1',
            'created_by' => 1
        ]);

        // \App\Models\Manufacturer::factory(10)->create();
        // \App\Models\ManufacturerAccount::factory(10)->create();
        // \App\Models\ProductCategory::factory(5)->create();
        // \App\Models\Product::factory(20)->create();

        // \App\Models\PurchaseOrder::factory(10)->create();
        // \App\Models\PurchaseOrderProduct::factory(20)->create();
    }
}
