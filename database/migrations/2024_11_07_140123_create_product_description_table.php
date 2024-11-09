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
        Schema::create('product_description', function (Blueprint $table) {
            $table->uuid('id_product_description')->primary();
            $table->uuid('id_category');
            $table->uuid('id_unit');
            $table->text('deskripsi');
            $table->text('side_effect');
            $table->integer('dosage');
            $table->enum('type', ['Umum', 'Resep dokter']);
            $table->text('product_img');

            $table->foreign('id_category')
                ->references('id_category')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('id_unit')
                ->references('id_unit')
                ->on('units')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_description');
    }
};
