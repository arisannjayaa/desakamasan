<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Ni Made Ria Handayani Scarpianti',
            'username' => 'riahandayani',
            'password' => bcrypt('riahandayani'),
            'email' => 'riahandayani@mail.com',
            'role' => 'Administrator',
        ]);

        User::create([
            'nama' => 'Anak Agung Aka Mas Pertiwi',
            'username' => 'maspertiwi',
            'password' => bcrypt('maspertiwi'),
            'email' => 'maspertiwi@mail.com',
            'role' => 'Administrator',
        ]);

        User::create([
            'nama' => 'Luh Ketut Pusparini',
            'username' => 'pusparini',
            'password' => bcrypt('pusparini'),
            'email' => 'pusparini@mail.com',
            'role' => 'Administrator',
        ]);
    }
}
