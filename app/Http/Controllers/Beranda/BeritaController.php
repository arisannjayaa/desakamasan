<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KategoriBerita;

class BeritaController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'Berita',
            'berita_simple' => Berita::orderBy('created_at', 'desc')->simplePaginate(12),
            'berita_all' => Berita::with('kategori', 'user')->orderBy('created_at', 'desc')->paginate(12),
            'berita_last' => Berita::with('kategori', 'user')->latest()->first(),
        ];
        return view('beranda.berita.index', $data);
    }

    public function show(String $slug)
    {
        $data = [
            'berita' => Berita::with('kategori', 'user')->where('slug', $slug)->first(),
            'berita_all' => Berita::latest()->take(5)->get()
        ];

        return view('beranda.berita.details', $data);
    }
}
