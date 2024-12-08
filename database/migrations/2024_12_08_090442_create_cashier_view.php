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
            DROP VIEW IF EXISTS vw_cashier;

            CREATE VIEW vw_cashier AS
            SELECT 
                u.id_user,
                c.id_cashier,
                u.name,
                c.gender,
                u.email,
                c.no_telp,
                c.address,
                u.password,
                u.role
            FROM 
                users u
            JOIN
                cashiers c ON u.id_user = c.id_user;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashier_view');
    }
};
