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
        $sql = "
            DROP VIEW IF EXISTS latest_order_view;

            CREATE VIEW latest_order_view AS
            SELECT 
                si.invoice_code,
                si.order_completed,
                si.payment_status,
                si.order_status,
                (
                    SELECT get_total_invoice_price(si.id_selling_invoice)
                ) AS Total
            FROM 
                selling_invoice AS si
            WHERE 
                payment_status = 'Pembayaran Berhasil' AND
                order_completed IS NOT NULL;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latest_order_view');
    }
};
