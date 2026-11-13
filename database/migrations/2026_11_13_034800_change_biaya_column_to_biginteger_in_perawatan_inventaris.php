<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ubah kolom biaya dari integer menjadi bigInteger
     * agar dapat menampung nilai hingga 9.223.372.036.854.775.807.
     */
    public function up(): void
    {
        Schema::table('perawatan_inventaris', function (Blueprint $table) {
            $table->bigInteger('biaya')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('perawatan_inventaris', function (Blueprint $table) {
            $table->integer('biaya')->nullable()->change();
        });
    }
};

