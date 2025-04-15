<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratTable extends Migration
{
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_nrp');
            $table->enum('jenis_surat', ['keterangan_aktif', 'pengantar_tugas', 'keterangan_lulus', 'laporan_hasil_studi']);
            $table->enum('status', ['diajukan', 'disetujui_kaprodi', 'disetujui_manager', 'ditolak', 'selesai'])->default('diajukan');
            $table->string('file_surat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
}
