<?php

namespace App\Http\Controllers\Berita;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BeritaController extends Controller
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
        (Session::has('image_folder')) ? Session::remove('image_folder') : Session::remove('image_filename');

        // Mengecek request dari datatables
        if (request()->ajax()) {
            // Query tabel berita
            $berita = Berita::select('id', 'judul', 'gambar', 'deskripsi')->orderBy('updated_at', 'desc');
            return DataTables::of($berita)
                // Menambahkan index kolom urutan angka dari 1
                ->addIndexColumn()
                // Mengedit kolom deskripsi
                ->editColumn('deskripsi', function($row) {
                    return '<span class="d-block text-truncate" style="max-width: 100px;">'.strip_tags($row->deskripsi).'</span>';
                })
                // Mengedit kolom judul
                ->editColumn('judul', function($row) {
                    return '<span class="d-block" style="max-width: 200px;">'.$row->judul.'</span>';
                })
                // Mengedit kolom gambar
                ->editColumn('gambar', function($row) {
                    return '<img height="50" width="50" src="' . asset('/storage/berita') . '/' . $row->gambar . '" alt="">';
                })
                // Menambahkan kolom baru untuk menambahkan button edit, delete dan lainnya
                ->addColumn('opsi', function($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu border border-1">
                        <li><span
                                onclick="window.location.href=\''.route('berita.edit', $row->id) .'\'"
                                role="button"class="dropdown-item">Edit</span></li>
                        <li><span onclick="window.location.href="
                                role="button"class="dropdown-item">Lihat</span></li>
                    </ul>
                </div>
                <form id="formDelete"  class="d-inline" action="'.route('berita.destroy', $row->id) .'"
                    method="post">
                    '.method_field('DELETE').'
                    '.csrf_field().'
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')"><i
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
                'url' => route('berita.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ]
        ];
        return view('berita.index', $data);
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
        // Melakukan validasi form dengan kustom pesan
        $request->validate([
            'judul' => 'required|unique:berita,judul',
            'slug' => 'required|unique:berita,slug',
            'deskripsi' => 'required',
        ],[
            'judul' => [
                'required' => 'Judul harus diisi',
                'unique' => 'Judul berita sudah ada!!'
            ],
            'slug' => [
                'required' => 'Slug harus diisi',
                'unique' => 'Slug berita sudah ada!!'
            ],
            'deskripsi.required' => 'Deskripsi harus diisi!!'
        ]);

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

        // Menghapus session penyimpanan gambar temporary
        Session::remove('image_folder');
        Session::remove('image_filename');

        // Menyimpan data berita ke tabel berita
        Berita::create([
            'judul' => $request->input('judul'),
            'slug' => $request->input('slug'),
            'deskripsi' => $request->input('deskripsi'),
            'gambar' =>  ($temporary->file) ? $temporary->file : null
        ]);

        // Mengarahkan url ke rute berita dengan method index dan mengirimkan session
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
        // Mendefinikasi data yang perlu dikirimkan ke view
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
        ],[
            'judul' => [
                'required' => 'Judul harus diisi',
                'unique' => 'Judul berita sudah ada!!'
            ],
            'slug' => [
                'required' => 'Slug harus diisi',
                'unique' => 'Slug berita sudah ada!!'
            ],
            'deskripsi.required' => 'Deskripsi harus diisi'
        ]);

        // Mencari berita berdasarkan id
        $berita = Berita::find($id);
        // Mengambil temporary file dari session
        $temporary = $this->temporaryFile->getFileFolder();
        // Mengecek session apakah null atau tidak
        $path = ($temporary->folder == null) ? '' : storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;

        // Mengecek session apakah memiliki data
        if(Session::has('image_folder')) {
            if(File::exists($path)){
                Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/berita' . '/' . $temporary->file);

                File::delete($path);
                rmdir(storage_path('app/files/tmp/') . $temporary->folder);
                $temporary->delete();
            }
            $pathOld = storage_path() . '/app/public/berita/' . $berita->gambar;
                if(File::exists($pathOld)) {
                    File::delete($pathOld);
                }
        }

        // Menyimpan data berita
        $berita->judul = $request->input('judul');
        $berita->slug = $request->input('slug');
        $berita->deskripsi = $request->input('deskripsi');
        $berita->gambar = ($temporary->file == null) ? $berita->gambar : $temporary->file ;
        $berita->save();

        // Mengarahkan kembali ke berita serta mengirimkan session
        return redirect()->route('berita.index')->with('success', 'Berhasil memperbaharui data');
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
        $path = storage_path() . '/app/public/berita/' . $berita->gambar;
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
