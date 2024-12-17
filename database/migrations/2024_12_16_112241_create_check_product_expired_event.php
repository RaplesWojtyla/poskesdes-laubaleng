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
            DROP EVENT IF EXISTS check_product_expired_event;

            CREATE EVENT check_product_expired_event
            ON SCHEDULE EVERY 1 DAY
            DO
                UPDATE products p
                JOIN products_detail pd ON p.id_product = pd.id_product
                SET p.status = 'Expired'
                WHERE pd.exp_date <= NOW() AND p.status = 'active';
        ";  

        // DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_product_expired_event');
    }
};
