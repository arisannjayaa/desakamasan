<?php

namespace Database\Seeders;

use App\Models\Profil;
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
        Profil::create([
            'nama' => 'Desa Kamasan',
            'deskripsi' => '<p>Desa Kamasan adalah sebuah desa yang terletak di Kecamatan Klungkung, Kabupaten Klungkung, Bali, Indonesia. Desa ini terkenal karena seni lukis tradisionalnya yang dikenal dengan sebutan "Lukisan Kamasan" atau "Gamelan Painting". Lukisan Kamasan merupakan seni lukis tradisional Bali yang memiliki ciri khas tersendiri. Lukisan ini umumnya menggambarkan cerita-cerita epik dan mitologi Hindu dalam gaya yang khas, dengan menggunakan warna-warna cerah dan pola-pola geometris. Lukisan Kamasan dipengaruhi oleh seni wayang kulit dan seni tari Bali, serta memiliki nilai budaya dan spiritual yang tinggi.</p><p>Selain seni lukis, Desa Kamasan juga memiliki potensi pariwisata budaya. Wisatawan dapat mengunjungi galeri seni di desa ini, melihat proses pembuatan lukisan Kamasan secara langsung, atau mengikuti workshop untuk belajar seni lukis tradisional Bali. Desa ini juga sering menjadi tujuan wisata budaya bagi mereka yang ingin menyaksikan pertunjukan wayang atau tari tradisional Bali.</p><p>Desa Kamasan juga dikenal sebagai Warisan Budaya Takbenda Indonesia yang diakui oleh UNESCO sejak tahun 2017. Pengakuan ini menjadi bukti penting akan keunikan dan nilai seni lukis Kamasan yang perlu dilestarikan dan diapresiasi.Desa Kamasan merupakan salah satu contoh desa di Bali yang kaya akan warisan seni dan budaya, dan memiliki potensi untuk pengembangan pariwisata budaya serta penghasilan ekonomi bagi masyarakat desa.</p>',
            'alamat' => 'Jalan Desa Kamasan, Klungkung',
            'telepon' => '0361077088099',
            'email' => 'desakamasan@gmail.com',
            'logo' => 'logo-kamasan.png',
            'video' => 'profil-kamasan.mp4',
            'latitude' => '-0',
            'longitude' => '01',
        ]);
    }
}
