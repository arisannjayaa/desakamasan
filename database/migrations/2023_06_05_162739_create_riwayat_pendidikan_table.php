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
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_pemerintah');
            $table->string('jenjang', 100);
            $table->string('institusi', 100);
            $table->year('tahun_lulus');
            $table->foreign('id_pemerintah')->references('id')->on('pemerintah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendidikan');
    }
};
