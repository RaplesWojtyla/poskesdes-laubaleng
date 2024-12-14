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
            DROP PROCEDURE IF EXISTS order_failed;

            CREATE PROCEDURE order_failed(
                IN `invoiceID` VARCHAR(36), 
                IN `cashierName` VARCHAR(255), 
                IN `comments` LONGTEXT
            )
            BEGIN
                UPDATE selling_invoice SET order_status = 'Pengambilan Gagal', cashier_name = cashierName, reject_comment = comments
                WHERE id_selling_invoice = invoiceID; 
            END;
        ";

        DB ::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('order_failed_procedure');
    }
};
