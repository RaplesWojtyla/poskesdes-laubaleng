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
            DROP PROCEDURE IF EXISTS add_item_to_cart;

            CREATE PROCEDURE add_item_to_cart(
                IN id_user_param CHAR(36),
                IN id_product_param CHAR(36),
                IN quantity_param INT
            )
            BEGIN
                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN 
                    ROLLBACK;
                END;

                START TRANSACTION;

                INSERT INTO carts (
                    id_cart,
                    id_user,
                    id_product,
                    quantity
                ) 
                VALUES (
                    UUID(),
                    id_user_param,
                    id_product_param, 
                    IFNULL(quantity_param, 1)
                );

                COMMIT;
            END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('add_item_to_cart');
    }
};
