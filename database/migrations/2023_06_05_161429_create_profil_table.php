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
        Schema::create('profil', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama', 60);
            $table->text('deskripsi');
            $table->string('alamat', 100);
            $table->string('telepon', 20);
            $table->string('email', 100);
            $table->string('logo', 255);
            $table->string('video', 255);
            $table->string('latitude', 255);
            $table->string('longitude', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil');
    }
};
