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
            DROP VIEW IF EXISTS vw_cart;

            CREATE VIEW vw_cart AS
            SELECT 
                c.id_cart,
                c.id_customer,
                vp.id_product,
                vp.product_name,
                vp.product_sell_price,
                vp.product_img,
                c.quantity,
                total_price(c.quantity, vp.product_sell_price) AS total_price
            FROM 
                carts c
            JOIN 
                vw_product vp ON c.id_product = vp.id_product;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('cart_view');
    }
};
