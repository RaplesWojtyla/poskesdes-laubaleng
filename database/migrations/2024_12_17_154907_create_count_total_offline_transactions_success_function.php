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
            DROP FUNCTION IF EXISTS count_total_offlline_transactions_success;

            CREATE FUNCTION count_total_offlline_transactions_success() 
            RETURNS INT
            DETERMINISTIC
            BEGIN
                RETURN (
                    SELECT 
                        COUNT(*) 
                    FROM 
                        selling_invoice
                    WHERE 
                        payment_status = 'Pembayaran Berhasil' AND
                        order_status = 'Offline'
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
        // Schema::dropIfExists('count_total_offlline_transactions_success');
    }
};
