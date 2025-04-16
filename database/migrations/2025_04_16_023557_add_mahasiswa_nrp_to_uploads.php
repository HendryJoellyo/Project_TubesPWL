<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMahasiswaNrpToUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploads', function (Blueprint $table) {
            // Menambahkan kolom mahasiswa_nrp
            $table->string('mahasiswa_nrp', 20)->nullable(); // Nullable untuk memungkinkan jika ada pengajuan tanpa nrp mahasiswa yang valid.

            // Menambahkan foreign key constraint untuk mahasiswa_nrp
            $table->foreign('mahasiswa_nrp')->references('nrp')->on('mahasiswa_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uploads', function (Blueprint $table) {
            // Menghapus kolom mahasiswa_nrp dan foreign key constraint
            $table->dropForeign(['mahasiswa_nrp']);
            $table->dropColumn('mahasiswa_nrp');
        });
    }
}
