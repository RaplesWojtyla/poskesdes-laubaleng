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
            DROP TRIGGER IF EXISTS cant_update_selling_invoice;

            CREATE TRIGGER cant_update_selling_invoice
            BEFORE UPDATE ON selling_invoice
            FOR EACH ROW
            BEGIN
                IF (
                    OLD.invoice_code <> NEW.invoice_code OR
                    OLD.id_customer <> NEW.id_customer OR
                    OLD.recipient_name <> NEW.recipient_name OR
                    OLD.recipient_phone <> NEW.recipient_phone OR
                    OLD.order_date <> NEW.order_date OR
                    OLD.recipient_payment <> NEW.recipient_payment OR
                    OLD.snap_token <> NEW.snap_token
                )
                THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Tidak Dapat Mengupdate Data Tersebut pada Invoice';
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
        // Schema::dropIfExists('cant_update_selling_invoice_trigger');
    }
};
