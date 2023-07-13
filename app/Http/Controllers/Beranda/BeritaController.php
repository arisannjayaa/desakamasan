<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Berita;
use App\Models\SosialMedia;
use Illuminate\Http\Request;
use App\Models\KategoriBerita;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
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
            'berita_simple' => Berita::orderBy('created_at', 'desc')->simplePaginate(12),
            'berita_all' => Berita::with('kategori', 'user')->orderBy('created_at', 'desc')->paginate(12),
            'berita_last' => Berita::with('kategori', 'user')->latest()->first(),
        ];
        return view('beranda.berita.index', $data);
    }

    public function show(String $slug)
    {
        $berita = Berita::with('kategori', 'user')
                    ->where('slug', $slug)->first();
        $data = [
            'berita' => $berita,
            'sosial_media' => $this->sosialMedia,
            'berita_all' => Berita::latest()
                            ->take(5)
                            ->where('id_kategori_berita', $berita->id_kategori_berita)
                            ->get()
        ];

        return view('beranda.berita.details', $data);
    }

    public function tags(String $slug)
    {
        // Temukan kategori berdasarkan slug
        $kategori = KategoriBerita::where('slug', $slug)->first();

        // Temukan berita yang terkait dengan kategori
        $berita = Berita::with('kategori', 'user')->whereHas('kategori', function ($query) use ($kategori) {
            $query->where('slug', $kategori->slug);
        })->get();

        $data = [
            'menu' => 'Berita',
            'berita_simple' => Berita::orderBy('created_at', 'desc')->simplePaginate(12),
            'berita_all' => Berita::with('kategori', 'user')->orderBy('created_at', 'desc')->paginate(12),
            'berita_last' => Berita::with('kategori', 'user')->latest()->first(),
        ];

        // Kembalikan data berita dan kategori ke view
        return view('beranda.berita.tag', compact('berita', 'kategori'));
    }
}
