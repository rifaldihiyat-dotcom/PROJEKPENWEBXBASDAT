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
        DB::statement('DROP VIEW IF EXISTS view_detail_buah');
        DB::statement("
            CREATE VIEW view_detail_buah AS 
            SELECT 
                b.id_buah, 
                b.nama_buah, 
                b.harga_jual, 
                b.gambar, 
                k.nama_kategori, 
                GROUP_CONCAT(s.nama_supplier SEPARATOR ', ') AS nama_supplier, 
                st.jumlah AS stok 
            FROM buah b 
            JOIN kategori k ON b.id_kategori = k.id_kategori 
            LEFT JOIN buah_supplier bs ON b.id_buah = bs.id_buah 
            LEFT JOIN supplier s ON bs.id_supplier = s.id_supplier 
            LEFT JOIN stok st ON b.id_buah = st.id_buah 
            GROUP BY b.id_buah, b.nama_buah, b.harga_jual, b.gambar, k.nama_kategori, st.jumlah
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_detail_buah');
    }
};
