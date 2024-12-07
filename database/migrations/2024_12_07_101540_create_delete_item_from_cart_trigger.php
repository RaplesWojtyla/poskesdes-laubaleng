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
            DROP TRIGGER IF EXISTS delete_item_from_cart;

            CREATE TRIGGER delete_item_from_cart
            AFTER UPDATE ON products
            FOR EACH ROW
            BEGIN
                IF (
                    NEW.status = 'Tidak Aktif' OR
                    NEW.status = 'Expired'
                ) 
                THEN
                    DELETE FROM carts
                    WHERE id_product = NEW.id_product;
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
        // Schema::dropIfExists('delete_item_from_cart_trigger');
    }
};
