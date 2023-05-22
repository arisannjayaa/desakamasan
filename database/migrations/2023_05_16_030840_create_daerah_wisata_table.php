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
        Schema::create('daerah_wisata', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_profil_desa')->default(1);
            $table->string('nama', 255);
            $table->string('slug', 255);
            $table->text('deskripsi');
            $table->string('alamat', 60);
            $table->text('gambar');
            $table->string('telepon', 20);
            $table->text('fasilitas');
            $table->string('longitude', 255);
            $table->string('latitude', 255);
            $table->string('kategori');
            $table->timestamps();
            $table->foreign('id_profil_desa')->references('id')->on('profil_desa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daerah_wisata');
    }
};
