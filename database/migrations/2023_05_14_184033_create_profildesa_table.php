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
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama', 60);
            $table->text('deskripsi');
            $table->string('alamat', 60);
            $table->string('telepon', 20);
            $table->string('foto_profil', 255);
            $table->text('gambar');
            $table->string('video', 20);
            $table->string('longitude', 255);
            $table->string('latitude', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desa');
    }
};
