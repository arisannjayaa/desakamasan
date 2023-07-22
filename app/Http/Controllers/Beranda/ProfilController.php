<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Profil;
use App\Models\SosialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    private $sosialMedia;
    public function __construct()
    {
        $this->sosialMedia = SosialMedia::all();
    }

    public function index()
    {
        $data = [
            'menu' => 'Profil Desa',
            'sosial_media' => $this->sosialMedia,
            'profil' => Profil::findorFail(1)
        ];
        return view('beranda.profil.index', $data);
    }
}
