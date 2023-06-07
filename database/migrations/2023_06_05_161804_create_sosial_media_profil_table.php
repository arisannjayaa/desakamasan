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
        Schema::create('sosial_media_profil', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama', 100);
            $table->string('no_url', 255);
            $table->unsignedBigInteger('id_profil');
            $table->foreign('id_profil')->references('id')->on('profil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosial_media_profil');
    }
};
