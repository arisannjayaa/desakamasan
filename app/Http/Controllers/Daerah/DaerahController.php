<?php

namespace App\Http\Controllers\Daerah;

use App\Models\Daerah;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\DaerahRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $temporaryFile;

    public function __construct()
    {
        $this->temporaryFile = new TemporaryFile();
    }
    public function index()
    {
        (Session::has('image_folder')) ? Session::remove('image_folder') : Session::remove('image_filename');

        if (request()->ajax()) {
            $daerah = Daerah::select('id', 'nama', 'alamat', 'kategori')->orderBy('updated_at', 'desc');
            return DataTables::of($daerah)
                ->addIndexColumn()
                ->addColumn('opsi', function($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu border border-1">
                        <li><span
                                onclick="window.location.href=\''.route('daerah.edit', $row->id) .'\'"
                                role="button"class="dropdown-item">Edit</span></li>
                        <li><span onclick="window.location.href="
                                role="button"class="dropdown-item">Lihat</span></li>
                    </ul>
                </div>
                <form class="d-inline" action="'.route('berita.destroy', $row->id) .'"
                    method="post">
                    '.method_field('DELETE').'
                    '.csrf_field().'
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')"><i
                            class="bi bi-trash-fill"></i></button>
                </form>';
                    })
                ->rawColumns(['opsi'])
                ->toJson(true);
        }

        $data = [
            'menu' => 'Daerah',
            'links' => [
                'url' => route('daerah.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ]
        ];
        return view('daerah.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'menu' => 'Daerah Baru',
            'links' => [
                'url' => route('daerah.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
        ];
        return view('daerah.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DaerahRequest $request)
    {
        $temporaryFolder = Session::get('image_folder');
        $temporaryFileName = Session::get('image_filename');

        // dd($temporaryFolder);

        // Mengambil temporary file dari session
        for ($i=0; $i < count($temporaryFolder); $i++) {
            $temporary = $this->temporaryFile
                            ->where('folder', $temporaryFolder[$i])
                            ->where('file', $temporaryFileName[$i])->first();
            if ($temporary) {
                // Mendefinisikan lokasi direktori asal file dan melakukan pemindahan file
                $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;
                if (File::exists($path)) {
                    Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/daerah' . '/' . $temporary->file);

                    // Menghapus file dari lokasi direktori
                    File::delete($path);
                    try {
                        rmdir(storage_path('app/files/tmp/') . $temporary->folder);
                        $temporary->delete();
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
            }
        }
        // Menghapus session penyimpanan gambar temporary
        Session::remove('image_folder');
        Session::remove('image_filename');

        // Menyimpan data berita ke tabel berita
        Daerah::create([
            'nama' => $request->input('nama'),
            'slug' => $request->input('slug'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'gambar' =>  ($temporary->file) ? json_encode($temporaryFileName) : null,
            'telepon' => $request->input('telepon'),
            'fasilitas' => json_encode($request->input('fasilitas')),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'kategori' => $request->input('kategori'),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambah daerah baru'
        ]);
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
        $daerah = Daerah::findOrFail($id);
        // Mendapatkan nilai JSON dari kolom yang diinginkan
        $jsonDataGambar = $daerah->gambar;
        $jsonDataFasilitas = $daerah->fasilitas;
        // Mengubah data JSON menjadi bentuk aslinya
        $dataGambar = json_decode($jsonDataGambar, true);
        $dataFasilitas = json_decode($jsonDataFasilitas, true);
        // Menyimpan data yang diubah dalam variabel $daerah
        $daerah->gambar = $dataGambar;
        $daerah->fasilitas = $dataFasilitas;
        // dd($daerah->gambar[3]);
        $data = [
            'menu' => 'Daerah Edit',
            'links' => [
                'url' => route('daerah.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'daerah' => $daerah
        ];
        return view('daerah.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DaerahRequest $request, string $id)
    {
        $temporaryFolder = Session::get('image_folder');
        $temporaryFileName = Session::get('image_filename');
        // Mencari berita berdasarkan id
        $daerah = Daerah::find($id);
        // dd($request);

        if(Session::has('image_folder')) {
            for ($i=0; $i < count($temporaryFolder); $i++) {
                $temporary = $this->temporaryFile
                                ->where('folder', $temporaryFolder[$i])
                                ->where('file', $temporaryFileName[$i])->first();
                if ($temporary) {
                    // Mendefinisikan lokasi direktori asal file dan melakukan pemindahan file
                    $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;
                    if (File::exists($path)) {
                        Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/daerah' . '/' . $temporary->file);

                        // Menghapus file dari lokasi direktori
                        File::delete($path);
                        try {
                            rmdir(storage_path('app/files/tmp/') . $temporary->folder);
                            $temporary->delete();
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
