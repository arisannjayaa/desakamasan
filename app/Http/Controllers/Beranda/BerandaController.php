<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Berita;
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
        $berita = Berita::where('slug', $slug)->first();
        // dd($berita);
        return view('beranda.berita-details', compact('berita'));
    }
}
