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
            DROP PROCEDURE IF EXISTS add_product_unit;

            CREATE PROCEDURE add_product_unit(
                IN unit_param VARCHAR(30)
            )
            BEGIN
                INSERT INTO units (
                    id_unit,
                    unit
                ) 
                VALUES (
                    UUID(),
                    unit_param
                );
            END;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('add_product_unit');
    }
};
