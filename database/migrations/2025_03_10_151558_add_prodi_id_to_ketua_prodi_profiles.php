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
            $table->unsignedBigInteger('prodi_id')->nullable()->after('tanggal_lahir');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('ketua_prodi_profiles', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
            $table->dropColumn('prodi_id');
        });
    }
    
};
