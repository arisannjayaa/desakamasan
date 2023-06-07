<?php

namespace Database\Seeders;

use App\Models\Daerah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 25; $i++) {
            Daerah::create([
                'nama' => 'nama-'. $i,
                'slug' => 'slug-'. $i,
                'deskripsi' => 'deskripsi-'. $i,
                'alamat' => 'alamat-'. $i,
                'gambar' =>  'gambar-'. $i,
                'telepon' => 'telepon-'. $i,
                'fasilitas' => 'fasilitas-'. $i,
                'latitude' => 'latitude-'. $i,
                'longitude' => 'longitude-'. $i,
                'kategori' => 'Wisata Alam',
            ]);
        }
    }
}
