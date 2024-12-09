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
        Schema::create('buying_invoices', function (Blueprint $table) {
            $table->uuid('id_buying_invoice')->primary();
            $table->string('kode_faktur', 8);
            $table->uuid('id_supplier');
            $table->timestamp('order_date');

            $table->foreign('id_supplier')
                ->references('id_supplier')
                ->on('suppliers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buying_invoices');
    }
};
