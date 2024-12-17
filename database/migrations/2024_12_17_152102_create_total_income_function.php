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
            DROP FUNCTION IF EXISTS calc_total_income_func;

            CREATE FUNCTION calc_total_income_func() 
            RETURNS DECIMAL(15, 2)
            DETERMINISTIC
            BEGIN
                DECLARE total_income DECIMAL(15, 2) DEFAULT 0;

                SELECT
                    SUM(get_total_invoice_price(id_selling_invoice)) INTO total_income
                FROM
                    selling_invoice
                WHERE
                    payment_status = 'Pembayaran Berhasil' AND
                    order_completed IS NOT NULL;

                RETURN total_income;
            END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('count_active_product_function');
    }
};
