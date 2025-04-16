<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('uploads', function (Blueprint $table) {
            // Drop foreign key constraint dulu sebelum drop kolom
            $table->dropForeign(['uploaded_by']); 
            $table->dropColumn('uploaded_by');

            // Tambahkan kolom status
            $table->string('status')->default('menunggu');
        });
    }

    public function down(): void
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');

            $table->dropColumn('status');
        });
    }
};
