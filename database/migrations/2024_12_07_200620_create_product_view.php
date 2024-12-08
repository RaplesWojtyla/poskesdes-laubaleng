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
            CREATE VIEW vw_product AS
            SELECT DISTINCT
                p.id_product,
                p.product_name,
                p.product_sell_price,
                p.status,
                c.category,
                u.unit,
                pd.golongan_obat,
                s.supplier,
                pd.deskripsi,
                pd.indication,
                pd.side_effect,
                pd.dosage,
                pd.NIE,
                pd.type,
                pd.product_img,
                (
                    SELECT d.exp_date
                    FROM products_detail d
                    WHERE d.stock > 0
                    AND d.id_product = p.id_product
                    ORDER BY d.exp_date
                    LIMIT 1
                ) AS product_expired_date,
                SUM(d.stock) AS product_stock,
                (
                    SELECT d.product_buy_price
                    FROM products_detail d
                    WHERE d.stock > 0
                    AND d.id_product = p.id_product
                    ORDER BY d.exp_date
                    LIMIT 1
                ) AS product_buy_price
            FROM 
                products p
            JOIN
                products_description pd ON p.id_product_description = pd.id_product_description
            JOIN
                categories c ON pd.id_category = c.id_category
            JOIN
                units u ON pd.id_unit = u.id_unit
            JOIN
                suppliers s ON pd.id_supplier = s.id_supplier
            JOIN
                products_detail d ON p.id_product = d.id_product
            GROUP BY
                p.id_product,
                p.product_name,
                p.product_sell_price,
                p.status,
                c.category,
                u.unit,
                pd.golongan_obat,
                s.supplier,
                pd.deskripsi,
                pd.indication,
                pd.side_effect,
                pd.dosage,
                pd.NIE,
                pd.type,
                pd.product_img
        ";

        DB::statement($sql); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_product');
    }
};
