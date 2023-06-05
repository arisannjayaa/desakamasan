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
        ]);

        KategoriDaerah::create([
            'nama' => 'Wisata Buatan',
        ]);

        KategoriDaerah::create([
            'nama' => 'Wisata Budaya',
        ]);
    }
}
