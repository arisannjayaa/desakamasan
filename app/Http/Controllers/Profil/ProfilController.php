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
            'menu' => 'Profil Desa',
            'links' => [
                'url' => '',
                'button' => 'Lihat Profil',
                'class' => 'btn-primary'
            ]
        ];

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
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto' => 'required',
            'video' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        $fileFoto = $request->file('foto');
        $fotoExtension = $fileFoto->extension();
        $fotoName = date('ymdhis') . "," . $fotoExtension;
        $fileFoto->move(public_path('upload'), $fotoName);

        $fileVideo = $request->file('video');
        $videoExtension = $fileVideo->extension();
        $videoName = date('ymdhis') . "," . $videoExtension;
        $fileVideo->move(public_path('upload'), $videoName);
        $data = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            'foto' => $fotoName,
            'video' => $videoName,
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
        ];
        Profil::create($data);
        return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
