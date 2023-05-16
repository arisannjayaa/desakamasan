<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profil_desa')->insert([
            'nama' => 'Nama desa wisata',
            'deskripsi' => '<p>Deskripsi desa wisata</p>',
            'alamat' => 'Alamat desa wisata',
            'telepon' => 'Telepon desa wisata',
            'foto_profil' => 'upload/profil/default_profil.svg',
            'gambar' => 'Foto desa wisata',
            'video' => 'Video desa wisata',
            'longitude' => 'Longitude desa wisata',
            'latitude' => 'Latitude desa wisata',
        ]);
    }
}
