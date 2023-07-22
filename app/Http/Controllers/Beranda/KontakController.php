<?php

namespace App\Http\Controllers\Beranda;

use App\Models\SosialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kontak;

class KontakController extends Controller
{
    private $sosialMedia;
    public function __construct()
    {
        $this->sosialMedia = SosialMedia::all();
    }

    public function index()
    {
        $data = [
            'menu' => 'Kontak Desa',
            'sosial_media' => $this->sosialMedia,
            'kontak' => Kontak::findorFail(1)
        ];
        return view('beranda.kontak.index', $data);
    }
}
