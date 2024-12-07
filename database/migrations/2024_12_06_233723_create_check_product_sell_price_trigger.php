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
        DROP TRIGGER IF EXISTS check_product_sell_price;

        CREATE TRIGGER check_product_sell_price_insert
        BEFORE INSERT ON products
        FOR EACH ROW
        BEGIN
            IF NEW.product_sell_price <= 0 THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Harga jual obat tidak boleh kurang dari atau sama dengan 0';
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
        // Schema::dropIfExists('check_product_sell_price_trigger');
    }
};
