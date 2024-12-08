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
            DROP VIEW IF EXISTS vw_customer;

            CREATE VIEW vw_customer AS
            SELECT 
                u.id_user,
                c.id_customer,
                u.name,
                u.email,
                c.no_telp,
                u.password,
                u.role
            FROM 
                users u
            JOIN
                customers c ON u.id_user = c.id_user;
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_view');
    }
};
