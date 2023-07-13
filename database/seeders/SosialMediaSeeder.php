<?php

namespace Database\Seeders;

use App\Models\SosialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SosialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Intsagram',
                'url' => 'https://www.instagram.com/desakamasan'
            ],
            [
                'nama' => 'Facebook',
                'url' => 'https://www.facebook.com/pages/Kantor-Perbekel-Desa-Kamasan/101359467912193'
            ]
        ];

        foreach ($data as  $row) {
            SosialMedia::create($row);
        }
    }
}
