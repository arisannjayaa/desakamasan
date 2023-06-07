<?php

namespace App\Http\Controllers\Daerah;

use App\Models\Daerah;
use App\Models\FotoDaerah;
use App\Models\TemporaryFile;
use App\Models\KategoriDaerah;
use App\Http\Controllers\Controller;
use App\Http\Requests\DaerahRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostDaerahController extends Controller
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
        if(Session::has('image_folder')) {
            Session::remove('image_folder');
            Session::remove('image_filename');
        }

        if (request()->ajax()) {
            $daerah = Daerah::select('id', 'nama', 'alamat', 'id_kategori_daerah')->orderBy('updated_at', 'desc');
            return DataTables::of($daerah)
                ->addIndexColumn()
                ->addColumn('opsi', function ($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu border border-1">
                        <li><span
                                onclick="window.location.href=\''.route('daerah-post.edit', $row->id) .'\'"
                                role="button"class="dropdown-item">Edit</span></li>
                        <li><span onclick="window.location.href="
                                role="button"class="dropdown-item">Lihat</span></li>
                    </ul>
                </div>
                <form id="myForm" class="d-inline" action="'.route('daerah-post.destroy', $row->id) .'"
                    method="post">
                    '.method_field('DELETE').'
                    '.csrf_field().'
                    <button onclick="deleteData()" type="button" class="btn btn-sm btn-danger"
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
                'url' => route('daerah-post.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ]
        ];
        return view('daerah.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'menu' => 'Daerah Baru',
            'links' => [
                'url' => route('daerah-post.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'kategori' => KategoriDaerah::all()
        ];
        return view('daerah.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DaerahRequest $request)
    {
        $temporaryFolder = Session::get('image_folder');
        $temporaryFileName = Session::get('image_filename');
        // dd(count($temporaryFileName));
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
        // dd($temporaryFileName);
        $daerah = Daerah::create([
            'nama' => $request->input('nama'),
            'slug' => $request->input('slug'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'id_kategori_daerah' => $request->input('kategori'),
        ]);

        foreach ($temporaryFileName as $row) {
            FotoDaerah::create([
                'id_daerah' => $daerah->id,
                'file' => $row
            ]);
        }

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
        $data = [
            'menu' => 'Daerah Edit',
            'links' => [
                'url' => route('daerah-post.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'daerah' => Daerah::findOrFail($id),
            'kategori' => KategoriDaerah::all()
        ];
        return view('daerah.post.edit', $data);
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

        $fotos = [];
        foreach ($daerah->foto as $foto) {
            $file = $foto->file;
            $filePath = storage_path('app/public/daerah/' . $file);

            if (File::exists($filePath)) {
                $fotos[] = $file;
            } else {
                FotoDaerah::where('file', $file)->delete();
                // echo 'file terhapus: ' . $file;
            }
        }

        $daerah->foto()->delete();
        // dd($fotos);

        if ($temporaryFileName == null) {
            $newFoto = $fotos;
        } else {
            $newFoto = array_merge($fotos, $temporaryFileName);
        }

        // $newFoto = array_unique($newFoto); // Menghapus duplikasi data
        foreach ($newFoto as $row) {
            $fotoDaerah = new FotoDaerah();
            $fotoDaerah->id_daerah = $daerah->id;
            $fotoDaerah->file = $row;
            $fotoDaerah->save();
        }

        $daerah->nama = $request->input('nama');
        $daerah->slug = $request->input('slug');
        $daerah->deskripsi = $request->input('deskripsi');
        $daerah->alamat = $request->input('alamat');
        $daerah->telepon = $request->input('telepon');
        $daerah->longitude = $request->input('longitude');
        $daerah->latitude = $request->input('latitude');
        $daerah->id_kategori_daerah = $request->input('kategori');
        $daerah->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil memperbaharui daerah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari data berdasarkam id
        $daerah = Daerah::find($id);

        foreach ($daerah->foto as $foto) {
            $file = $foto->file;
            $filePath = storage_path('app/public/daerah/' . $file);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $daerah->foto()->delete();
        $daerah->delete();
        // Mengirim response dalam bentok json
        return response()->json([
            'status' => 200,
            'message' => 'Data daerah berhasil dihapus!'
        ]);
    }
}
