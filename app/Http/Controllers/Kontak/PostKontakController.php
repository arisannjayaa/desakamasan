<?php

namespace App\Http\Controllers\Kontak;

use App\Http\Controllers\Controller;
use App\Http\Requests\KontakRequest;
use App\Models\Kontak;
use Illuminate\Http\Request;

class PostKontakController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => 'Kontak Desa',
            'links' => [
                'url' => '',
                'button' => 'Lihat Kontak',
                'class' => 'btn-primary'
            ],
            'kontak' => Kontak::find(1)
        ];

        // dd($data['profil'])
        // dd(Profil::all());

        return view('kontak.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KontakRequest $request, String $id)
    {
        Kontak::where('id', $id)
            ->update([
                'telepon' => $request->input('telepon'),
                'alamat' => $request->input('alamat'),
                'email' => $request->input('email'),
                'longitude' => $request->input('longitude'),
                'latitude' => $request->input('latitude'),
            ]);

        // Mengarahkan url ke rute berita dengan method index dan mengirimkan session
        // return redirect()->route('berita.index')->with('success', 'Berhasil menambahkan data berita');
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambahkan data berita'
        ]);
    }
}
