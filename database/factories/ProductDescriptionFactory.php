<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDescription>
 */
class ProductDescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_categories = Category::all()->pluck('id_category');
        $id_category = fake()->randomElement($id_categories);

        $id_units = Unit::all()->pluck('id_unit');
        $id_unit = fake()->randomElement($id_units);

        return [
            'id_product_description' => fake()->uuid,
            'id_category' => $id_category,
            'id_unit' => $id_unit,
            'golongan_obat' => fake()->randomElement(['Bebas', 'Bebas Terbatas', 'Keras', 'Narkotika']),
            'deskripsi' => fake()->sentences(6, true),
            'indication' => fake()->sentences(fake()->randomElement([0,6]), true),
            'side_effect' => fake()->sentences(6, true),
            'dosage' => fake()->sentences(6, true),
            'NIE' => 'DKL'. fake()->numberBetween(100000000,999999999) .'A21',
            'type' => fake()->randomElement(['Umum', 'Resep dokter']),
            'product_img' => 'product_img/01JFBZ9VG4T9MDRXWV23Z60KB3.jpg'
        ];
    }
}
