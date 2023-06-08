<?php

namespace App\Http\Controllers\Beranda;

use App\Models\Daerah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DaerahController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'Daerah',
            'daerah_simple' => Daerah::orderBy('created_at', 'desc')->simplePaginate(12),
            'daerah_all' => Daerah::with('kategori')->orderBy('created_at', 'desc')->paginate(12),
            'daerah_last' => Daerah::with('kategori')->latest()->first(),
        ];
        return view('beranda.daerah.index', $data);
    }

    public function show(String $slug)
    {
        $data = [
            'daerah' => Daerah::with('kategori')->where('slug', $slug)->first(),
            'daerah_all' => Daerah::latest()->take(5)->get()
        ];

        return view('beranda.daerah.details', $data);
    }
}
