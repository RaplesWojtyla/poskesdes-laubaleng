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
            DROP PROCEDURE IF EXISTS stock_back;

            CREATE PROCEDURE stock_back(
                IN quantity INT, 
                IN id_product CHAR(36)
            )
            BEGIN 
                UPDATE products_detail
                SET stock = stock + quantity
                WHERE id_product = id_product
                ORDER BY product_expired LIMIT 1;
            END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('stock_back_procedure');
    }
};
