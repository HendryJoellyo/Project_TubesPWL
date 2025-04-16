<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropMahasiswaNrpFromSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Menghapus foreign key constraint sebelum menghapus kolom
        Schema::table('surat', function (Blueprint $table) {
            $table->dropForeign(['mahasiswa_nrp']); // Menghapus foreign key
            $table->dropColumn('mahasiswa_nrp');    // Menghapus kolom mahasiswa_nrp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Mengembalikan kolom mahasiswa_nrp dan foreign key jika migration di-rollback
        Schema::table('surat', function (Blueprint $table) {
            $table->string('mahasiswa_nrp', 20); // Menambah kolom mahasiswa_nrp
            $table->foreign('mahasiswa_nrp')->references('nrp')->on('mahasiswa_profiles')->onDelete('cascade'); // Menambahkan foreign key kembali
        });
    }
}
