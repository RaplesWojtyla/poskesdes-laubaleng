<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_products = Product::all()->pluck('id_product');
        $id_product = fake()->unique()->randomElement($id_products);

        $stock = rand(15,70);

        return [
            'id_product_detail' => fake()->uuid,
            'id_product' => $id_product,
            'exp_date' => fake()->dateTimeBetween('-1 years', '+3 years'),
            'stock' => $stock,
            'product_buy_price' => fake()->numberBetween(700,190000),
        ];
    }
}
