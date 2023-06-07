<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daerah', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama', 255);
            $table->text('deskripsi');
            $table->string('slug', 255);
            $table->string('alamat', 255);
            $table->string('telepon', 20);
            $table->text('latitude');
            $table->text('longitude');
            $table->unsignedBigInteger('id_kategori_daerah');
            $table->foreign('id_kategori_daerah')->references('id')->on('kategori_berita');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daerah');
    }
};
