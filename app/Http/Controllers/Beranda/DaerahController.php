<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Daerah;
use App\Models\SosialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DaerahController extends Controller
{
    private $sosialMedia;
    public function __construct()
    {
        $this->sosialMedia = SosialMedia::all();
    }

    public function index()
    {
        $data = [
            'menu' => 'Daerah',
            'sosial_media' => $this->sosialMedia,
            'daerah_simple' => Daerah::orderBy('created_at', 'desc')->simplePaginate(12),
            'daerah_all' => Daerah::with('kategori')->orderBy('created_at', 'desc')->paginate(12),
            'daerah_last' => Daerah::with('kategori')->latest()->first(),
        ];
        return view('beranda.daerah.index', $data);
    }

    public function show(String $slug)
    {
        $daerah = Daerah::with('kategori')
                    ->where('slug', $slug)->first();
        $data = [
            'daerah' => $daerah,
            'sosial_media' => $this->sosialMedia,
            'daerah_all' => Daerah::latest()
                            ->take(5)
                            ->where('id_kategori_daerah', $daerah->id_kategori_daerah)
                            ->get()
        ];

        return view('beranda.daerah.details', $data);
    }
}
