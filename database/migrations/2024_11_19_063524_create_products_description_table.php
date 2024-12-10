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
        Schema::create('products_description', function (Blueprint $table) {
            $table->uuid('id_product_description')->primary();
            $table->uuid('id_category');
            $table->uuid('id_unit');
            $table->enum('golongan_obat', ['Bebas', 'Bebas Terbatas', 'Keras', 'Narkotika']);
            $table->text('deskripsi');
            $table->text('indication');
            $table->text('side_effect');
            $table->text('dosage');
            $table->string('NIE', 15);
            $table->enum('type', ['Umum', 'Resep dokter']);
            $table->text('product_img');

            $table->foreign('id_category')
                ->references('id_category')
                ->on('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            
            $table->foreign('id_unit')
                ->references('id_unit')
                ->on('units')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_description');
    }
};
