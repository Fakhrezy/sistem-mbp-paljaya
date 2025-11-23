<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE monitoring_barang MODIFY COLUMN status ENUM('diajukan','diterima','ditolak') NOT NULL DEFAULT 'diajukan'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE monitoring_barang MODIFY COLUMN status ENUM('diajukan','diterima') NOT NULL DEFAULT 'diajukan'");
    }
};
