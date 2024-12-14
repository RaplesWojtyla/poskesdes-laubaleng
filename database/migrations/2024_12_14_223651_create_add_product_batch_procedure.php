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
            DROP PROCEDURE IF EXISTS add_batch_procedure;

            CREATE PROCEDURE add_batch_procedure(
                IN product_id_param CHAR(36),
                IN detail_id_param CHAR(36), 
                IN harga_beli_param INT, 
                IN expired_date_param TIMESTAMP, 
                IN stock_param INT
            )
            BEGIN
                DECLARE is_transaction_successful BOOLEAN DEFAULT TRUE;

                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    SET is_transaction_successful = FALSE;
                    ROLLBACK;
                END;
                
                START TRANSACTION;

                INSERT INTO products_detail (id_product, id_product_detail, product_buy_price, exp_date, stock)
                VALUES (product_id_param, detail_id_param, harga_beli_param, expired_date_param, stock_param);

                IF is_transaction_successful THEN
                    COMMIT;
                END IF;
            END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('add_product_batch_procedure');
    }
};
