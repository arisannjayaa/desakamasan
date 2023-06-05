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
        Schema::create('foto_profil', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_profil');
            $table->string('file'. 255);
            $table->foreign('id_profil')->references('id')->on('profil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_profil');
    }
};
