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
            DROP FUNCTION IF EXISTS count_active_product;

            CREATE FUNCTION count_active_product()
            RETURNS INT
            DETERMINISTIC
            BEGIN
                RETURN (SELECT COUNT(*) FROM products WHERE status = 'Aktif');
            END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('count_active_product_function');
    }
};
