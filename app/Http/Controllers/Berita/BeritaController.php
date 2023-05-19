<?php

namespace App\Http\Controllers\Berita;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Session::has('image_folder')) {
            Session::remove('image_folder');
            Session::remove('image_filename');
        }
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
        $request->validate([
            'judul' => 'required',
            'slug' => 'required',
            'deskripsi' => 'required',
        ]);


        $data = [
            'judul' => $request->input('judul'),
            'slug' => $request->input('slug'),
            'deskripsi' => $request->input('deskripsi'),
            'foto' =>  $temporary->file
        ];

        $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;
        Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/berita' . '/' . $temporary->file);

        File::delete($path);
        rmdir(storage_path('app/files/tmp/') . $temporary->folder);
        $temporary->delete();

        Session::remove('image_folder');
        Session::remove('image_filename');

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
        $request->validate([
            'judul' => 'required',
            'slug' => 'required',
            'deskripsi' => 'required',
        ]);

        $temporary = TemporaryFile::getTemporaryFileFolder();

        $berita = Berita::find($id);
        dd($temporary);

        $berita->judul = $request->input('judul');
        $berita->slug = $request->input('slug');
        $berita->deskripsi = $request->input('deskripsi');
        // dd( $berita->foto);
        $berita->save();
        return redirect()->route('berita.index')->with('success', 'Berhasil memperbaharui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
