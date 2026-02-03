<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            // Ubah ke BIGINT UNSIGNED (untuk harga yang selalu positif)
            $table->unsignedBigInteger('harga_barang')->change();

            // ATAU gunakan DECIMAL jika butuh desimal
            // $table->decimal('harga_barang', 15, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->integer('harga_barang')->change();
        });
    }
};
