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
        Schema::create('pemerintah', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama', 255);
            $table->string('jabatan', 60);
            $table->string('tempat_lahir', 70);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 40);
            $table->string('status_kawin', 40);
            $table->unsignedInteger('jumlah_anak');
            $table->string('pendidikan_terakhir', 100);
            $table->string('alamat', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemerintah');
    }
};
