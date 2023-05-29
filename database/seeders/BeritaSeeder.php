<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 250; $i++) {
            Berita::create([
                'judul' => 'judul-'. $i,
                'slug' => 'slug-'. $i,
                'gambar' => 'img-'. $i . '.jpg',
                'deskripsi' => 'deskripsi-' . $i,
            ]);
        }
    }
}
