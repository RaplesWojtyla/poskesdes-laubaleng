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
        Schema::create('products_detail', function (Blueprint $table) {
            $table->uuid('id_product_detail')->primary();
            $table->uuid('id_product');
            $table->date('exp_date');
            $table->integer('stock');
            $table->integer('product_buy_price');

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
        Schema::dropIfExists('products_detail');
    }
};
