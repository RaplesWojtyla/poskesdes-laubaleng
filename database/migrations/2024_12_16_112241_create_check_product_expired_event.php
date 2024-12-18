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
            DROP EVENT IF EXISTS check_product_expired_event;
            
            CREATE EVENT check_product_expired_event
            ON SCHEDULE EVERY 1 DAY
            DO
                UPDATE products p
                JOIN (
                    SELECT
                        pd.id_product,
                        MAX(pd.exp_date) AS exp_date
                    FROM
                        products_detail pd
                    GROUP BY
                        pd.id_product
                ) sub ON p.id_product = sub.id_product
                SET p.status = 'Expired'
                WHERE sub.exp_date <= NOW();
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('check_product_expired_event');
    }
};
