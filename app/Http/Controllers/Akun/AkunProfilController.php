<?php

namespace App\Http\Controllers\Akun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkunProfilController extends Controller
{
    public function index(String $username)
    {
        $data = [
            'menu' => 'Akun Profil',
        ];
        return view('akun.profil', $data);
    }
}
