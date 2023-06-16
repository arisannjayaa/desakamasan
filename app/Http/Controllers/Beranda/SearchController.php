<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Berita;
use App\Models\Daerah;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $beritaResults = Berita::where('judul', 'LIKE', "%$query%")->get();
        $daerahResults = Daerah::where('nama', 'LIKE', "%$query%")->get();
        $produkResults = Produk::where('nama', 'LIKE', "%$query%")->get();

        $results = [];

        foreach ($beritaResults as $berita) {
            $results[] = [
                'type' => 'berita',
                'judul' => $berita->judul,
                'slug' => $berita->slug,
            ];
        }

        foreach ($daerahResults as $daerah) {
            $results[] = [
                'type' => 'daerah',
                'judul' => $daerah->nama,
                'slug' => $daerah->slug,
            ];
        }

        foreach ($produkResults as $produk) {
            $results[] = [
                'type' => 'produk',
                'judul' => $produk->nama,
                'slug' => $produk->slug,
            ];
        }

        return response()->json($results);
    }
}
