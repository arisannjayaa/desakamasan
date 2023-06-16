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
}
