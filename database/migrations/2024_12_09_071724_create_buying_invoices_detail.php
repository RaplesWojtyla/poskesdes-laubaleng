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
        Schema::create('buying_invoices_detail', function (Blueprint $table) {
            $table->uuid('id_buying_invoice_detail')->primary();
            $table->uuid('id_buying_invoice');
            $table->string('product_name', 100);
            $table->integer('product_buy_price');
            $table->timestamp('exp_date');
            $table->integer('quantity');

            $table->foreign('id_buying_invoice')
                ->references('id_buying_invoice')
                ->on('buying_invoices')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buying_invoices_detail');
    }
};
