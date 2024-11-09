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
        Schema::create('detail_invoice', function (Blueprint $table) {
            $table->uuid('id_detail_invoice')->primary();
            $table->uuid('id_invoice');
            $table->string('product_name', 100);
            $table->enum('product_type', ['Umum', 'Resep dokter']);
            $table->integer('quantity');
            $table->integer('product_sell_price');

            $table->foreign('id_invoice')
                ->references('id_invoice')
                ->on('invoice')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_invoice');
    }
};
