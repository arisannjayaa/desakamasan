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
            'berita_all' => DB::table('berita')->paginate(12),
            'berita_last' => Berita::latest()->first()
        ];
        return view('beranda.berita', $data);
    }
}
