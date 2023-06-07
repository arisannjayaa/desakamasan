<?php

namespace Database\Seeders;

use App\Models\KategoriBerita;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBerita::create([
            'nama' => 'Seni dan Budaya',
            'slug' => 'seni-dan-budaya'
        ]);

        KategoriBerita::create([
            'nama' => 'Alam dan Wisata',
            'slug' => 'alam-dan-wisata'
        ]);

        KategoriBerita::create([
            'nama' => 'Sosial dan Masyarakat',
            'slug' => 'sosial-dan-masyarakat'
        ]);
    }
}
