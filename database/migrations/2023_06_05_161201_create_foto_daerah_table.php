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
        Schema::create('foto_daerah', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_daerah');
            $table->string('file', 255);
            $table->foreign('id_daerah')->references('id')->on('daerah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_daerah');
    }
};
