<?php

use Illuminate\Database\Migrations\Migration;
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
            DROP TRIGGER IF EXISTS update_selling_invoice;

            CREATE TRIGGER update_selling_invoice
            AFTER UPDATE ON selling_invoice
            FOR EACH ROW
            BEGIN
                IF NEW.order_status <> OLD.order_status 
                THEN
                    CALL insert_log(
                        NEW.invoice_code,
                        NEW.cashier_name,
                        'order_status',
                        'update',
                        OLD.order_status,
                        NEW.order_status
                    );
                END IF;

                IF NEW.payment_status <> OLD.payment_status 
                THEN
                    CALL insert_log(
                        NEW.invoice_code,
                        'midtrans',
                        'payment_status',
                        'update',
                        OLD.payment_status,
                        NEW.payment_status
                    );
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
        //
    }
};
