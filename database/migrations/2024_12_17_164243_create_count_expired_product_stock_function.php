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
            DROP FUNCTION IF EXISTS count_expired_product_stock;

            CREATE FUNCTION count_expired_product_stock() 
            RETURNS INT
            DETERMINISTIC
            BEGIN
                RETURN (
                    SELECT 
                        SUM(stock)
                    FROM 
                        products_detail
                    WHERE 
                        exp_date <= NOW()
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
        // Schema::dropIfExists('count_expired_product_stock');
    }
};
