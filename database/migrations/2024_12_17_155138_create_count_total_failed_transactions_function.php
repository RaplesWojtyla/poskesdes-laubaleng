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
            DROP FUNCTION IF EXISTS count_total_failed_transactions;

            CREATE FUNCTION count_total_failed_transactions() 
            RETURNS INT
            DETERMINISTIC
            BEGIN
                RETURN (
                    SELECT 
                        COUNT(*) 
                    FROM 
                        selling_invoice
                    WHERE 
                        payment_status = 'Pembayaran Gagal' OR
                        order_status = 'Dibatalkan' OR
                        order_status = 'Pengambilan Gagal'
                );
            END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('count_total_failed_transactions');
    }
};
