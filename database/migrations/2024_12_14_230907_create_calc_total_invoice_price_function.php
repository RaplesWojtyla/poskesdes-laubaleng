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
            DROP FUNCTION IF EXISTS get_total_invoice_price;
            
            CREATE FUNCTION get_total_invoice_price(id_selling_invoice CHAR(36))
            RETURNS DECIMAL(15, 2)
            DETERMINISTIC
            BEGIN
                DECLARE total_price DECIMAL(15, 2);

                SELECT SUM(total_price(quantity, product_sell_price))
                INTO total_price
                FROM selling_invoice_detail AS sid
                WHERE sid.id_selling_invoice COLLATE utf8mb4_unicode_ci  = id_selling_invoice COLLATE utf8mb4_unicode_ci;

                RETURN IFNULL(total_price, 0);
            END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calc_total_invoice_price_function');
    }
};
