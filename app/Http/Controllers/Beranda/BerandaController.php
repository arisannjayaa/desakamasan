<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Berita;
use App\Models\Daerah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    public function index()
    {
        return view('beranda.index');
    }

    public function berita()
    {
        $data = [
            'menu' => 'Berita',
            'berita_simple' => Berita::orderBy('created_at', 'desc')->simplePaginate(12),
            'berita_all' => Berita::orderBy('created_at', 'desc')->paginate(12),
            'berita_last' => Berita::latest()->first()
        ];
        return view('beranda.berita', $data);
    }

    public function details_berita(String $slug)
    {
        $data = [
            'berita' => Berita::where('slug', $slug)->first(),
            'berita_all' => Berita::latest()->take(5)->get()
        ];

        return view('beranda.berita-details', $data);
    }

    public function daerah()
    {
        $daerah = Daerah::all();
        $daerahLast = Daerah::latest()->first();
        $daerahLast->gambar = json_decode($daerahLast->gambar);
        $daerahAll = Daerah::orderBy('created_at', 'DESC')
                    ->paginate(12);

        $daerahAll->getCollection()->transform(function ($item) {
            $item->gambar = json_decode($item->gambar);
            return $item;
        });

        $data = [
            'menu' => 'Daerah',
            'daerah_simple' => Daerah::orderBy('created_at', 'desc')->simplePaginate(12),
            'daerah_all' => $daerahAll,
            'daerah_last' => $daerahLast
        ];
        return view('beranda.daerah', $data);
    }

    public function details_daerah(String $slug)
    {
        $data = [
            'daerah' => Daerah::where('slug', $slug)->first(),
            'daerah_all' => Daerah::latest()->take(5)->get()
        ];

        return view('beranda.daerah-details', $data);
    }
}
