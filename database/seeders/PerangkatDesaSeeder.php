<?php

namespace Database\Seeders;

use App\Models\Pemerintah;
use App\Models\RiwayatKerja;
use App\Models\RiwayatPendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerangkatDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'I Gede Buda Artawan, S.SOS',
                'slug' => '',
                'jabatan' => 'Perbekel',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Laki-Laki',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'I Kadek Mariana',
                'slug' => '',
                'jabatan' => 'Sekretaris',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Laki-Laki',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'I Ketut Wijaya',
                'slug' => '',
                'jabatan' => 'Kasi Pem',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Laki-Laki',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Ni Wayan Sri Sayoanyani',
                'slug' => '',
                'jabatan' => 'Kasi Kesra',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Ida Ayu Nyoman Sayang',
                'slug' => '',
                'jabatan' => 'Kasi Pelayanan',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Ni Nyoman Suresni',
                'slug' => '',
                'jabatan' => 'Kaur Umum',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Luh De Made Widiantari',
                'slug' => '',
                'jabatan' => 'Kaur Perencanaan',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'I Ketut Astika',
                'slug' => '',
                'jabatan' => 'Kalian Dinas Tabanan',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Laki-Laki',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'I Made Sudiarta',
                'slug' => '',
                'jabatan' => 'Kalian Dinas KacangDawa',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Laki-Laki',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'I Made Suwisna',
                'slug' => '',
                'jabatan' => 'Kelian Dinas Sangging',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Laki-Laki',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Ni Made Ria Handayani Scarpianti',
                'slug' => '',
                'jabatan' => 'Admin',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Anak Agung Aka Mas Pertiwi',
                'slug' => '',
                'jabatan' => 'Admin',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Luh Ketut Pusparini, SE',
                'slug' => '',
                'jabatan' => 'Admin',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Ngakan Made Suardika',
                'slug' => '',
                'jabatan' => 'Kelian Br. Dinas Pande Mas',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Ni Kadek Yulik Tiap Andewi',
                'slug' => '',
                'jabatan' => 'Kaur Keuangan',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'I Made Kurniawan',
                'slug' => '',
                'jabatan' => 'Penyuluh Bahasa Bali',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Laki-Laki',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
            [
                'nama' => 'Putu Prema Pradayanti',
                'slug' => '',
                'jabatan' => 'Yowana Gema Santi',
                'tempat_lahir' => 'Kamasan',
                'tanggal_lahir' => '1987-10-10',
                'jenis_kelamin' => 'Perempuan',
                'status_kawin' => 'Kawin',
                'jumlah_anak' => 1,
                'pendidikan_terakhir' => 'S1',
                'alamat' => 'Jalan Desa Kamasan',
                'foto' => 'not-found.jpg',
            ],
        ];

        $pendidikan = [
            [
                'id_pemerintah' => 1,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 2,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 3,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 4,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 5,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 6,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 7,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 8,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 9,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 10,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 11,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 12,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 13,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 14,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 15,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 16,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
            [
                'id_pemerintah' => 17,
                'jenjang' =>  'S1',
                'institusi' => 'Universitas Indonesia',
                'tahun_lulus' => '2021'
            ],
        ];

        $kerja = [
            [
                'id_pemerintah' => 1,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 2,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 3,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 4,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 5,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 6,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 7,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 8,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 9,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 10,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 11,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 12,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 13,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 14,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 15,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 16,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
            [
                'id_pemerintah' => 17,
                'perusahaan_organisasi' => 'Kantor Desa',
                'tahun_mulai' => '2021',
                'tahun_selesai' => 'Sekarang'
            ],
        ];

        foreach ($data as  $row) {
            Pemerintah::create($row);
        }

        foreach ($pendidikan as $row) {
            RiwayatPendidikan::create($row);
        }

        foreach ($kerja as $row) {
            RiwayatKerja::create($row);
        }
    }
}
