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
        DROP PROCEDURE IF EXISTS insert_log;

        CREATE PROCEDURE insert_log(
            IN invoiceCode varchar(255), 
            IN username varchar(255), 
            IN target VARCHAR(100), 
            IN description VARCHAR(6), 
            IN oldValue LONGTEXT, 
            IN newValue LONGTEXT
        )
        BEGIN
            INSERT INTO logs (
                id_log, 
                log_time,
                reference, 
                pelaku, 
                log_target, 
                log_description, 
                old_value, 
                new_value
            )
            VALUES (
                UUID(), 
                NOW(), 
                invoiceCode, 
                username, 
                target, 
                description, 
                oldValue, 
                newValue
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
        // Schema::dropIfExists('insert_log_procedure');
    }
};
