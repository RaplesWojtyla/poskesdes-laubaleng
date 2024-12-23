<?php

namespace Database\Factories;

use App\Models\ProductDescription;
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
    public function definition(): array
    {
        $id_products_description = ProductDescription::pluck('id_product_description')->all();
        $id_product_description = fake()->unique()->randomElement($id_products_description);

        return [
            'id_product' => fake()->uuid,
            'product_name' => fake()->text(50),
            'id_product_description' => $id_product_description,
            'product_sell_price' => fake()->numberBetween(1000,200000),
            'status'=> fake()->randomElement(['Aktif', 'Expired']),
        ];
    }
}
