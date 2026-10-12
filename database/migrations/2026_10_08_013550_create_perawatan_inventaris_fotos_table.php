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
        Schema::create('perawatan_inventaris_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perawatan_inventaris_id')->constrained('perawatan_inventaris')->onDelete('cascade');
            $table->string('foto_bukti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perawatan_inventaris_fotos');
    }
};
