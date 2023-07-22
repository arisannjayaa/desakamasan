<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kontak::create([
            'telepon' => '0366 555 1764',
            'email' => 'info@kamasan.desa.id',
            'alamat' => 'Jl. Nirarta Desa Kamasan, Kecamatan Klungkung, Kabupaten Klungkung, Provinsi Bali',
            'latitude' => '-8.548444',
            'longitude' => '115.408116',
        ]);
    }
}
