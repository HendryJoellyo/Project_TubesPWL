<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {   
        // 1. Buat Tabel Dosen Terlebih Dahulu
        Schema::create('dosen_profiles', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('nik')->unique();
            $table->string('name');
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
        

        // 2. Buat Tabel Prodi
        Schema::create('prodi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_prodi');
            $table->timestamps();
        });

        // 3. Buat Tabel Ketua Prodi
        Schema::create('ketua_prodi_profiles', function (Blueprint $table) {
            $table->string('nik', 20)->primary();
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('set null');
            $table->foreign('nik')->references('nik')->on('dosen_profiles')->onDelete('cascade'); 
            $table->timestamps();
        });

     

        // 5. Buat Tabel Tata Usaha
        Schema::create('tata_usaha_profiles', function (Blueprint $table) {
            $table->string('nik', 20)->primary();
            $table->string('name');
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // 6. Buat Tabel Manajer Operasional
        Schema::create('manajer_operasional_profiles', function (Blueprint $table) {
            $table->string('nik', 20)->primary();
            $table->string('name');
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // 7. Buat Tabel Users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin','mahasiswa', 'ketua_prodi', 'manager_operasional', 'tata_usaha']);
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('set null');
            $table->timestamps();
        });

        // 8. Buat Tabel Mahasiswa
        Schema::create('mahasiswa_profiles', function (Blueprint $table) {
            $table->string('nrp', 20)->primary();
            $table->string('name');
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('prodi_id');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('cascade');
            $table->timestamps();
        });

        // 9. Buat Tabel Surat
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_nrp', 20);
            $table->foreign('mahasiswa_nrp')->references('nrp')->on('mahasiswa_profiles')->onDelete('cascade');
            $table->enum('jenis_surat', ['keterangan_aktif', 'pengantar_tugas', 'keterangan_lulus', 'laporan_hasil_studi']);
            $table->enum('status', ['diajukan', 'disetujui_kaprodi', 'disetujui_manager', 'ditolak', 'selesai'])->default('diajukan');
            $table->string('file_surat')->nullable();
            $table->timestamps();
        });

        // 10. Buat Tabel Approvals
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->foreignId('approved_by')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['disetujui', 'ditolak']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // 11. Buat Tabel Uploads
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->string('file_path');
            $table->timestamps();
        });

        // 12. Buat Tabel Sessions
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
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('uploads');
        Schema::dropIfExists('approvals');
        Schema::dropIfExists('surat');
        Schema::dropIfExists('mahasiswa_profiles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('tata_usaha_profiles');
        Schema::dropIfExists('manajer_operasional_profiles');
        Schema::dropIfExists('ketua_prodi_profiles');
        Schema::dropIfExists('dosen_profiles');
        Schema::dropIfExists('prodi');
    }
};
