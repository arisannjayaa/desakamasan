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
        Schema::create('riwayat_kerja', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_pemerintah');
            $table->string('perusahaan_organisasi', 255);
            $table->string('tahun_mulai');
            $table->string('tahun_selesai');
            $table->foreign('id_pemerintah')->references('id')->on('pemerintah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_kerja');
    }
};
