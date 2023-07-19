<?php

namespace App\Http\Controllers\Beranda;

use App\Models\SosialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pemerintah;

class PerangkatDesaController extends Controller
{
    private $sosialMedia;
    public function __construct()
    {
        $this->sosialMedia = SosialMedia::all();
    }

    public function index()
    {
        $data = [
            'menu' => 'Perangkat Desa',
            'sosial_media' => $this->sosialMedia,
            'perangkat_simple' => Pemerintah::orderBy('created_at', 'desc')->simplePaginate(12),
            'perangkat_all' => Pemerintah::orderBy('created_at', 'desc')->paginate(12),
            'perangkat_last' => Pemerintah::latest()->first(),
        ];
        return view('beranda.perangkat-desa.index', $data);
    }

    public function show(String $slug)
    {
        $data = [
            'menu' => 'Perangkat Desa',
            'perangkat' => Pemerintah::with('riwayat_kerja', 'riwayat_pendidikan')
            ->where('slug', $slug)->first(),
            'sosial_media' => $this->sosialMedia,
        ];

        return view('beranda.perangkat-desa.details', $data);
    }
}
