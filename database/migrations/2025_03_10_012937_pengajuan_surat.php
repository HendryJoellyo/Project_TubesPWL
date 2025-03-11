<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {   
        // 1. Buat Tabel Ketua Prodi Dulu
        Schema::create('ketua_prodi_profiles', function (Blueprint $table) {
            $table->string('nik', 20)->primary();
            $table->string('name');
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // 2. Buat Tabel Prodi Setelahnya
        Schema::create('prodi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_prodi');
            $table->string('ketua_prodi_nik', 20)->nullable(); // Tidak ada foreign key di sini dulu
            $table->timestamps();
        });

        // 3. Tambahkan Foreign Key Setelah Kedua Tabel Dibuat
        Schema::table('prodi', function (Blueprint $table) {
            $table->foreign('ketua_prodi_nik')->references('nik')->on('ketua_prodi_profiles')->onDelete('set null');
        });

        // 4. Buat Tabel Lainnya
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['mahasiswa', 'ketua_prodi', 'manager_operasional', 'tata_usaha']);
            $table->foreignId('prodi_id')->nullable()->constrained('prodi')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('mahasiswa_profiles', function (Blueprint $table) {
            $table->string('nrp', 20)->primary();
            $table->string('name');
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('prodi_id')->constrained('prodi')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_nrp', 20);
            $table->foreign('mahasiswa_nrp')->references('nrp')->on('mahasiswa_profiles')->onDelete('cascade');
            $table->enum('jenis_surat', ['keterangan_aktif', 'pengantar_tugas', 'keterangan_lulus', 'laporan_hasil_studi']);
            $table->enum('status', ['diajukan', 'disetujui_kaprodi', 'disetujui_manager', 'ditolak', 'selesai'])->default('diajukan');
            $table->string('file_surat')->nullable();
            $table->timestamps();
        });

        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->foreignId('approved_by')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['disetujui', 'ditolak']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->string('file_path');
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uploads');
        Schema::dropIfExists('approvals');
        Schema::dropIfExists('surat');
        Schema::dropIfExists('mahasiswa_profiles');
        Schema::dropIfExists('prodi');
        Schema::dropIfExists('ketua_prodi_profiles'); // Pindah ke akhir
        Schema::dropIfExists('users');
    }
};

