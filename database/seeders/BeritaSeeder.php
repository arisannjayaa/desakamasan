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
        for ($i = 0; $i < 25; $i++) {
            Berita::create([
                'judul' => 'judul-'. $i,
                'slug' => 'slug-'. $i,
                'foto' => 'img-'. $i . '.jpg',
                'deskripsi' => 'deskripsi-' . $i,
            ]);
        }
    }
}
