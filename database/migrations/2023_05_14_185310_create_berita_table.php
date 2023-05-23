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
            $table->id('id');
            $table->unsignedBigInteger('id_profil_desa')->default(1);
            $table->string('judul', 255);
            $table->string('slug', 255);
            $table->string('gambar', 255)->nullable();
            $table->text('deskripsi');
            $table->timestamps();
            $table->foreign('id_profil_desa')->references('id')->on('profil_desa');
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
