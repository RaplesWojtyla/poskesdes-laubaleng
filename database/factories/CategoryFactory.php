<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Alergi', 'Asam Urat', 'Demam', 'Diabetes', 'Flu dan Batuk', 'Hipertensi', 'Kesehatan Wanita', 'Pencernaan'];
        $category = fake()->unique()->randomElement($categories);

        return [
            'id_category' => fake()->uuid,
            'category' => $category,
            'category_img' => 'categories/' . $category . '.png',
        ];
    }
}
