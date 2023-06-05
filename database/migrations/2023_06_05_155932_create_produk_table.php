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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama', 255);
            $table->string('slug', 255);
            $table->string('alamat', 255);
            $table->unsignedBigInteger('id_kategori_produk');
            $table->text('deskripsi');
            $table->timestamps();
            $table->foreign('id_kategori_produk')->references('id')->on('kategori_produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
