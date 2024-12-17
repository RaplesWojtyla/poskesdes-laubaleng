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
            DROP PROCEDURE IF EXISTS add_product_category;

            CREATE PROCEDURE add_product_category(
                IN category_param VARCHAR(30),
                IN image_path TEXT
            )
            BEGIN
                INSERT INTO categories (
                    id_category,
                    category,
                    category_img
                ) 
                VALUES (
                    UUID(),
                    category_param,
                    image_path
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
        // Schema::dropIfExists('add_product_category');
    }
};
