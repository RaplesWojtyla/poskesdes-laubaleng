<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cashiers', function (Blueprint $table) {
            $table->uuid('id_cashier')->primary();
            $table->uuid('id_user')->unique();
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->string('agama', 10);
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->string('no_telp', 14);
            $table->text('address');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashiers');
    }
};
