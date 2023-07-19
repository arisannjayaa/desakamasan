<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            ],
            'profil' => Profil::find(1)
        ];

        // dd($data['profil'])
        // dd(Profil::all());

        return view('profil.index', $data);
    }

    public function page()
    {
        return view('profil.page', [
            'profil' => Profil::all()->where('id', '>', 0)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->all());
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'foto_profil' => 'required',
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