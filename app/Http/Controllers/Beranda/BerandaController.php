<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Berita;
use App\Models\Daerah;
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
        $data = [
            'menu' => 'Berita',
            'sosial_media' => $this->sosialMedia,
        ];
        return view('beranda.index', $data);
    }
}
