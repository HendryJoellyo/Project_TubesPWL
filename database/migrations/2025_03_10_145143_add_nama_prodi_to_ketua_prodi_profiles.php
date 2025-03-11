<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('ketua_prodi_profiles', function (Blueprint $table) {
        $table->string('nama_prodi')->after('name');
    });
}

public function down()
{
    Schema::table('ketua_prodi_profiles', function (Blueprint $table) {
        $table->dropColumn('nama_prodi');
    });
}

};
