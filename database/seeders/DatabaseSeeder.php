<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductDetail;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create([
            'role' => 'user',
            'password' => Hash::make('qwertyui'),
        ]);
        
        \App\Models\User::factory(3)->create([
            'role' => 'cashier',
            'password' => Hash::make('12345678'),
        ]);
        
        \App\Models\User::factory(1)->create([
            'email' => 'owner@gmail.com',
            'role' => 'owner',
            'password' => Hash::make('1234567890'),
        ]);

        Customer::factory(10)->create();
        Cashier::factory(3)->create();

        Category::factory(8)->create();
        Unit::factory(8)->create();

        ProductDescription::factory(30)->create();
        Product::factory(30)->create();
        ProductDetail::factory(30)->create();
    }
}
