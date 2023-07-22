<?php

namespace App\Http\Controllers\Profil;

use App\Models\Profil;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostProfilController extends Controller
{

    protected $temporaryFile;

    public function __construct()
    {
        $this->temporaryFile = new TemporaryFile();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Session::has('image_folder')) {
            Session::remove('image_folder');
            Session::remove('image_filename');
        }

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

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfilRequest $request, String $id)
    {
        // Mengambil temporary file dari session
        $temporary = $this->temporaryFile->getFileFolder();

        // Mengecek session apakah null atau tidak
        $path = ($temporary->folder == null) ? '' : storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;

        // Mengecek session apakah memiliki data
        if (Session::has('image_folder')) {
            if (File::exists($path)) {
                Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/profil' . '/' . $temporary->file);

                File::delete($path);
                rmdir(storage_path('app/files/tmp/') . $temporary->folder);
                $temporary->delete();
            }
        }

        Profil::where('id', $id)
            ->update([
                'nama' => $request->input('nama'),
                'deskripsi' => $request->input('deskripsi'),
                'visi' => $request->input('visi'),
                'misi' => $request->input('misi'),
                'foto' => $request->input('gambar'),
                'video' => $request->input('video'),
            ]);

        // Mengarahkan url ke rute berita dengan method index dan mengirimkan session
        // return redirect()->route('berita.index')->with('success', 'Berhasil menambahkan data berita');
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambahkan data berita'
        ]);
    }
}
