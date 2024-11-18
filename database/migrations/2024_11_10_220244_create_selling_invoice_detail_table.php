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
        Schema::create('selling_invoice_detail', function (Blueprint $table) {
            $table->uuid('id_selling_invoice_detail')->primary();
            $table->uuid('id_selling_invoice');
            $table->string('product_name', 100);
            $table->enum('product_type', ['Umum', 'Resep dokter']);
            $table->integer('quantity');
            $table->integer('product_sell_price');

            $table->foreign('id_selling_invoice')
                ->references('id_selling_invoice')
                ->on('selling_invoice')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling_invoice_detail');
    }
};
