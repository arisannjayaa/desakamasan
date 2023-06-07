<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriProduk::create([
            'nama' => 'Budaya',
            'slug' => 'budaya'
        ]);

        KategoriProduk::create([
            'nama' => 'Kuliner',
            'slug' => 'kuliner'
        ]);

        KategoriProduk::create([
            'nama' => 'Pariwisata',
            'slug' => 'pariwisata'
        ]);

        KategoriProduk::create([
            'nama' => 'Seni Kerajinan',
            'slug' => 'seni-kerajinan'
        ]);
    }
}
