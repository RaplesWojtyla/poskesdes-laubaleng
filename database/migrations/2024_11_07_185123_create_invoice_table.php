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
        Schema::create('invoice', function (Blueprint $table) {
            $table->uuid('id_invoice')->primary();
            $table->string('invoice_code', 20)->unique();
            $table->string('cashier_name', 100)->nullable();
            $table->uuid('id_customer')->nullable();
            $table->string('recipient_name', 100)->nullable();
            $table->string('recipient_phone', 14)->nullable();
            $table->string('recipient_bank', 100)->nullable();
            $table->text('recipient_payment');
            $table->text('resep_dokter')->nullable();
            $table->timestamp('order_date');
            $table->timestamp('order_completed')->nullable();
            $table->enum('order_status', ['Berhasil', 'Gagal', 'Menunggu Pengembalian', 'Menunggu Konfirmasi', 'Menunggu Pengambilan', 'Offline']);

            $table->foreign('id_customer')
                ->references('id_customer')
                ->on('customers')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
