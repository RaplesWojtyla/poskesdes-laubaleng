<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('selling_invoice', function (Blueprint $table) {
            $table->uuid('id_selling_invoice')->primary();
            $table->string('invoice_code', 20)->unique();
            $table->string('cashier_name', 100)->nullable();
            $table->char('id_customer', 36)->nullable();
            $table->string('recipient_name', 100)->nullable();
            $table->string('recipient_phone', 14)->nullable();
            $table->string('recipient_payment', 100);
            $table->text('resep_dokter')->nullable();
            $table->timestamp('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('order_completed')->nullable();
            $table->text('refund_file')->nullable();
            $table->string('reject_reason')->nullable();
            $table->enum('payment_status', ['Menunggu Pembayaran', 'Pembayaran Berhasil', 'Pembayaran Gagal']);
            $table->enum('order_status', ['Refund', 'Menunggu Pengambilan', 'Pengambilan Gagal', 'Dibatalkan', 'Pengambilan Berhasil'])->nullable();
            $table->string('snap_token', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_customer')
                ->references('id_customer')
                ->on('customers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling_invoice');
    }
};
