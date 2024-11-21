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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id_product')->primary();
            $table->string('product_name', 100);
            $table->uuid('id_product_description');
            $table->integer('product_sell_price');
            $table->enum('status', ['Aktif', 'Tidak Aktif', 'Expired']);
            $table->timestamps();

            $table->foreign('id_product_description')
                ->references('id_product_description')
                ->on('products_description')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
