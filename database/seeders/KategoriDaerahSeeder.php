<?php

namespace Database\Seeders;

use App\Models\KategoriDaerah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriDaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriDaerah::create([
            'nama' => 'Wisata Alam',
            'slug' => 'wisata-alam'
        ]);

        KategoriDaerah::create([
            'nama' => 'Wisata Buatan',
            'slug' => 'wisata-buatan'
        ]);

        KategoriDaerah::create([
            'nama' => 'Wisata Budaya',
            'slug' => 'wisata-budaya'
        ]);
    }
}
