<?php

namespace App\Http\Controllers\Berita;

use App\Models\Berita;
use App\Models\TemporaryFile;
use App\Models\KategoriBerita;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeritaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostBeritaController extends Controller
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
        // Mengecek session gambar
        if(Session::has('image_folder')) {
            Session::remove('image_folder');
            Session::remove('image_filename');
        }

        // Mengecek request dari datatables
        if (request()->ajax()) {
            // Query tabel berita
            $berita = Berita::with('kategori')->select('id', 'judul', 'foto', 'deskripsi', 'slug', 'id_kategori_berita')->orderBy('updated_at', 'desc');
            return DataTables::of($berita)
                // Menambahkan index kolom urutan angka dari 1
                ->addIndexColumn()
                // Mengedit kolom deskripsi
                ->editColumn('deskripsi', function ($row) {
                    return '<span class="d-block text-truncate" style="max-width: 100px;">'.strip_tags($row->deskripsi).'</span>';
                })
                // Mengedit kolom judul
                ->editColumn('judul', function ($row) {
                    return '<span class="d-block" style="max-width: 200px;">'.$row->judul.'</span>';
                })
                // Mengedit kolom gambar
                ->editColumn('gambar', function ($row) {
                    return '<img style="object-fit: cover;" height="50" width="50" src="' . asset('/storage/berita') . '/' . $row->foto . '" alt="">';
                })
                // Menambahkan kolom baru untuk menambahkan button edit, delete dan lainnya
                ->addColumn('opsi', function ($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu border border-1">
                        <li><span
                                onclick="window.location.href=\''.route('berita-post.edit', $row->id) .'\'"
                                role="button"class="dropdown-item">Edit</span></li>
                        <li><span onclick="window.location.href=\''.route('berita.show', $row->slug) .'\'"
                                role="button"class="dropdown-item">Lihat</span></li>
                    </ul>
                </div>
                <form id="myForm"  class="d-inline" action="'.route('berita-post.destroy', $row->id) .'"
                    method="post">
                    '.method_field('DELETE').'
                    '.csrf_field().'
                    <button onclick="deleteData()" type="button"  class="btn btn-sm btn-danger"><i
                            class="bi bi-trash-fill"></i></button>
                </form>';
                })
                // Mendefinisikan kolom yang sudah ditambahkan tadi maupun kolom yang diedit
                ->rawColumns(['opsi', 'deskripsi', 'gambar', 'judul'])
                ->toJson(true);
        }

        // Mendefinikasi data yang perlu dikirimkan ke view
        $data = [
            'menu' => 'Berita',
            'links' => [
                'url' => route('berita-post.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ]
        ];
        return view('berita.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mendefinikasi data yang perlu dikirimkan ke view
        $data = [
            'menu' => 'Berita Baru',
            'links' => [
                'url' => route('berita-post.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'kategori' => KategoriBerita::all()
        ];
        return view('berita.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BeritaRequest $request)
    {
        // Mengambil temporary file dari session
        $temporary = $this->temporaryFile->getFileFolder();

        // Mendefinisikan lokasi direktori asal file dan melakukan pemindahan file
        $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;
        Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/berita' . '/' . $temporary->file);

        // Menghapus file dari lokasi direktori
        File::delete($path);
        try {
            rmdir(storage_path('app/files/tmp/') . $temporary->folder);
            $temporary->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }

        // Menyimpan data berita ke tabel berita
        Berita::create([
            'judul' => $request->input('judul'),
            'slug' => $request->input('slug'),
            'deskripsi' => $request->input('deskripsi'),
            'foto' =>  ($temporary->file) ? $temporary->file : null,
            'id_kategori_berita' => $request->input('kategori'),
            'id_user' => Auth::user()->id,
        ]);

        // Mengarahkan url ke rute berita dengan method index dan mengirimkan session
        // return redirect()->route('berita.index')->with('success', 'Berhasil menambahkan data berita');
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambahkan data berita'
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
        // Mendefinikasi data yang perlu dikirimkan ke view
        $data = [
            'menu' => 'Berita Edit',
            'links' => [
                'url' => route('berita-post.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'berita' => Berita::findOrFail($id),
            'kategori' => KategoriBerita::all()
        ];
        return view('berita.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BeritaRequest $request, string $id)
    {
        // Mencari berita berdasarkan id
        $berita = Berita::find($id);

        // Mengambil temporary file dari session
        $temporary = $this->temporaryFile->getFileFolder();

        // Mengecek session apakah null atau tidak
        $path = ($temporary->folder == null) ? '' : storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;

        // Mengecek session apakah memiliki data
        if(Session::has('image_folder')) {
            if(File::exists($path)) {
                Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/berita' . '/' . $temporary->file);

                File::delete($path);
                rmdir(storage_path('app/files/tmp/') . $temporary->folder);
                $temporary->delete();
            }
        }

        $foto = basename($request->input('gambar'));
        // Menyimpan data berita
        $berita->judul = $request->input('judul');
        $berita->slug = $request->input('slug');
        $berita->deskripsi = $request->input('deskripsi');
        $berita->id_kategori_berita = $request->input('kategori');
        $berita->id_user = Auth::user()->id;
        $berita->foto = ($temporary->file == null) ? $foto : $temporary->file ;
        $berita->save();

        // Mengarahkan kembali ke berita serta mengirimkan session
        // return redirect()->route('berita.index')->with('success', 'Berhasil memperbaharui data');
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil memperbaharui data berita'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari data berdasarkam id
        $berita = Berita::find($id);

        // Mendefinisika path penyimpanan gambar dserta
        // melakukan pengecekan untuk penghapusan gambar
        $path = storage_path() . '/app/public/berita/' . $berita->foto;
        if(File::exists($path)) {
            File::delete($path);
        }
        $berita->delete();

        // Mengirim response dalam bentok json
        return response()->json([
            'status' => 200,
            'message' => 'Data berita berhasil dihapus!'
        ]);
    }
}
