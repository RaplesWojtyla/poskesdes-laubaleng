<?php

namespace Database\Factories;

use App\Models\Cashier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cashier>
 */
class CashierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id_user = User::where('role', 'cashier')->pluck('id_user')->all();
        $id = fake()->unique()->randomElement($id_user);

        return [
            'id_cashier' => fake()->uuid,
            'id_user' => $id,
            'gender' => Arr::random(['pria', 'wanita']),
            'no_telp' => '08'.strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)).strval(fake()->numberBetween(10, 99)),
            'address' => fake()->sentence(10),
        ];
    }
}
