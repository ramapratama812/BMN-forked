<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bmn_ruangans', function (Blueprint $table) {
            $table->string('gambar_ruangan')->nullable()->after('nama_ruangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bmn_ruangans', function (Blueprint $table) {
            $table->dropColumn('gambar_ruangan');
        });
    }
};
