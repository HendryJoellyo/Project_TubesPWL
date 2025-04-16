<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropStatusAndFileSuratFromSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Menghapus kolom status dan file_surat dari tabel surat
        Schema::table('surat', function (Blueprint $table) {
            $table->dropColumn(['status', 'file_surat']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Menambahkan kolom status dan file_surat kembali jika migration di-rollback
        Schema::table('surat', function (Blueprint $table) {
            $table->enum('status', ['diajukan', 'disetujui_kaprodi', 'disetujui_manager', 'ditolak', 'selesai'])->default('diajukan');
            $table->string('file_surat')->nullable();
        });
    }
}

