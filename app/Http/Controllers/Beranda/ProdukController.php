<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'Produk',
            'produk_simple' => Produk::orderBy('created_at', 'desc')->simplePaginate(12),
            'produk_all' => Produk::with('kategori')->orderBy('created_at', 'desc')->paginate(12),
            'produk_last' => Produk::with('kategori')->latest()->first(),
        ];
        return view('beranda.produk.index', $data);
    }

    public function show(String $slug)
    {
        $data = [
            'produk' => Produk::with('kategori')->where('slug', $slug)->first(),
            'produk_all' => Produk::latest()->take(5)->get()
        ];

        return view('beranda.produk.details', $data);
    }
}
