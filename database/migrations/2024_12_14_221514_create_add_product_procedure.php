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
            DROP PROCEDURE IF EXISTS add_product_procedure;

            CREATE PROCEDURE add_product_procedure(
                IN id_product CHAR(36),
                IN product_name VARCHAR(255),
                IN product_status ENUM('Aktif', 'Tidak Aktif', 'Expired'),
                IN gambar_obat_file VARCHAR(255),
                IN id_desc CHAR(36),
                IN kategori CHAR(36),
                IN satuan_obat CHAR(36),
                IN golongan ENUM('Bebas', 'Bebas Terbatas', 'Keras', 'Narkotika'),
                IN product_NIE VARCHAR(15),
                IN tipe ENUM('Umum', 'Resep dokter'),
                IN description LONGTEXT,
                IN efek_samping LONGTEXT,
                IN dosis LONGTEXT,
                IN indikasi LONGTEXT,
                IN harga_beli INT,
                IN expired_date TIMESTAMP,
                IN harga_jual INT,
                IN stock INT,
                IN detail_id CHAR(36)
            )
            BEGIN
                DECLARE is_transaction_successful BOOLEAN DEFAULT TRUE;

                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    SET is_transaction_successful = FALSE;
                    ROLLBACK;
                END;
                START TRANSACTION;

                INSERT INTO products_description (
                    id_product_description, 
                    id_category,
                    id_unit, 
                    golongan_obat, 
                    deskripsi, 
                    indication, 
                    side_effect, 
                    dosage, 
                    NIE, 
                    type, 
                    product_img
                ) 
                VALUES (
                    id_desc,
                    kategori,
                    satuan_obat,
                    golongan, 
                    description, 
                    indikasi, 
                    produksi, 
                    deskripsi, 
                    efek_samping, 
                    dosis, 
                    product_NIE, 
                    tipe, 
                    gambar_obat_file
                );

                INSERT INTO products (id_product, status, product_name, product_sell_price, id_product_description)
                VALUES (id_product, product_status, product_name, harga_jual, id_desc);

                INSERT INTO products_detail (id_product, id_product_detail, product_buy_price, exp_date, stock)
                VALUES (id_product, detail_id, harga_beli, expired_date, stock);

                IF is_transaction_successful THEN
                    COMMIT;
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
        // Schema::dropIfExists('add_product_procedure');
    }
};
