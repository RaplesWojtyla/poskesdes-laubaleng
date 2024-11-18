<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id_cart')->primary();
            $table->uuid('id_customer');
            $table->uuid('id_product');
            $table->integer('quantity');

            $table->foreign('id_customer')
                ->references('id_customer')
                ->on('customers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('id_product')
                ->references('id_product')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
