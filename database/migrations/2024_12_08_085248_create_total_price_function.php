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
            DROP FUNCTION IF EXISTS total_price;

            CREATE FUNCTION total_price(
                quantity INT, 
                price INT
            )
            RETURNS INT
            DETERMINISTIC
            BEGIN
                RETURN (price * quantity);
            END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('total_price_function');
    }
};
