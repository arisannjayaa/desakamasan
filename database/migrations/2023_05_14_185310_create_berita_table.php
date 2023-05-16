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
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->unsignedBigInteger('id_profil_desa');
            $table->string('judul', 255);
            $table->string('slug', 255);
            $table->string('foto', 255);
            $table->text('deskripsi');
            $table->timestamps();
            $table->foreign('id_profil_desa')->references('id_profil_desa')->on('profil_desa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
