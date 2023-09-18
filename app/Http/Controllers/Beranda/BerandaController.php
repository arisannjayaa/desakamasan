<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Berita;
use App\Models\Daerah;
use App\Models\Produk;
use App\Models\Profil;
use App\Models\SosialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    private $sosialMedia;
    public function __construct()
    {
        $this->sosialMedia = SosialMedia::all();
    }

    public function index()
    {
        $data =
        [
            'title' => "Berita kami",
            'berita' => Berita::limit(3)->get(),
            'daerah' => Daerah::limit(3)->get(),
            'produk' => Produk::limit(3)->get(),
            'desa' => Profil::get(),
            'sosial_media' => $this->sosialMedia,
        ];
//        dd($data);
        return view('beranda.index', $data);
    }
}
