<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Daerah;
use App\Models\Pemerintah;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'Dashboard',
            'berita' => Berita::count(),
            'pemerintah' => Pemerintah::count(),
            'produk' => Produk::count(),
            'daerah' => Daerah::count(),
        ];
        return view('dashboard.index', $data);
    }
}
