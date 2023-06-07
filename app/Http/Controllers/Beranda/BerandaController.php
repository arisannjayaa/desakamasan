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

    public function daerah()
    {
        $data = [
            'menu' => 'Daerah',
            'daerah_simple' => Daerah::orderBy('created_at', 'desc')->simplePaginate(12),
            'daerah_all' => Daerah::all(),
            'daerah_last' => Daerah::latest()->first()
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
