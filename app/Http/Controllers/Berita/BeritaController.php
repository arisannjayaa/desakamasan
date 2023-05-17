<?php

namespace App\Http\Controllers\Berita;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'menu' => 'Berita',
            'links' => [
                'url' => route('berita.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ],
            'berita' => Berita::all()
        ];
        return view('berita.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'menu' => 'Berita Baru',
            'links' => [
                'url' => route('berita.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
        ];
        return view('berita.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'judul' => 'required',
            'slug' => 'required',
            'deskripsi' => 'required',
        ]);

        $fileFoto = $request->file('gambar');
        $fotoExtension = $fileFoto->extension();
        $fotoName = date('ymdhis') . "." . $fotoExtension;
        $fileFoto->move(public_path('upload/berita'), $fotoName);

        $data = [
            'judul' => $request->input('judul'),
            'slug' => $request->input('slug'),
            'deskripsi' => $request->input('deskripsi'),
            'foto' => 'upload/berita/' . $fotoName
        ];

        // dd($data);
        Berita::create($data);
        return redirect()->route('berita.index')->with('success', 'Berhasil menambahkan data berita');
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
        $data = [
            'menu' => 'Berita Baru',
            'links' => [
                'url' => route('berita.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'berita' => Berita::findOrFail($id)
        ];
        return view('berita.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        $fileFoto = $request->file('gambar');
        $fotoExtension = $fileFoto->extension();
        $fotoName = date('ymdhis') . "." . $fotoExtension;
        $fileFoto->move(public_path('upload/berita'), $fotoName);

        $berita = Berita::find($id);
        // dd($berita);
        $berita->judul = $request->input('judul');
        $berita->slug = $request->input('slug');
        $berita->deskripsi = $request->input('deskripsi');
        $berita->foto = $fotoName;
        dd( $berita->foto);
        $berita->save();
        return redirect()->back()->with('success', 'Berhasil memperbaharui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
