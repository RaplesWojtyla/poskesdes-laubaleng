<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_user = User::where('role', 'user')->pluck('id_user')->all();
        $id = fake()->unique()->randomElement($id_user);

        return [
            'id_customer' => fake()->uuid,
            'id_user' => $id,
            'no_telp' => '08'.strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)),
        ];
    }
}
