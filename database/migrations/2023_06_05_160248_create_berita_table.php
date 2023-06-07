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
            $table->string('judul', 255);
            $table->string('slug', 255);
            $table->string('foto', 255)->nullable();
            $table->text('deskripsi');
            $table->unsignedBigInteger('id_user')->default(1);;
            $table->unsignedBigInteger('id_kategori_berita');
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('user');
            $table->foreign('id_kategori_berita')->references('id')->on('kategori_berita');
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
