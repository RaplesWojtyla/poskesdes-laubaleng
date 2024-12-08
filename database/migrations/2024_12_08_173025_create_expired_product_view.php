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
            DROP VIEW IF EXISTS vw_expired_product;

            CREATE VIEW vw_expired_product AS
            SELECT 
                p.id_product,
                p.product_name,
                pd.stock,
                s.supplier,
                pdesc.product_img
            FROM 
                products p
            JOIN
                products_description pdesc ON p.id_product_description = pdesc.id_product_description
            JOIN
                products_detail pd ON p.id_product = pd.id_product
            JOIN
                suppliers s ON pdesc.id_supplier = s.id_supplier
            WHERE 
                pd.exp_date <= NOW();
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('expired_product_view');
    }
};
