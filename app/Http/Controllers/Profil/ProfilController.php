<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'profil' => Profil::all(),
            'menu' => 'Profil Desa',
            'links' => [
                'url' => '',
                'button' => 'Lihat Profil',
                'class' => 'btn-primary'
            ],
        ];

        // dd(Profil::all());

        return view('profil.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto_profil' => 'required',
            'gambar' => 'required',
            'video' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        $fileFoto = $request->file('foto');
        $fotoExtension = $fileFoto->extension();
        $fotoName = date('ymdhis') . "." . $fotoExtension;
        $fileFoto->move(public_path('upload'), $fotoName);

        $fileVideo = $request->file('video');
        $videoExtension = $fileVideo->extension();
        $videoName = date('ymdhis') . "." . $videoExtension;
        $fileVideo->move(public_path('upload'), $videoName);

        $profil = Profil::find($request->id);
        $profil->nama = $request->input('nama');
        $profil->deskripsi = $request->input('deskripsi');
        $profil->alamat = $request->input('alamat');
        $profil->telepon = $request->input('telepon');
        $profil->foto = $fotoName;
        $profil->video = $videoName;
        $profil->longitude = $request->input('longitude');
        $profil->latitude = $request->input('latitude');
        $profil->save();
        return redirect()->back()->with('success', 'Berhasil memperbaharui data');
    }

}
