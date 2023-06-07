<?php

namespace App\Http\Controllers\Produk;

use App\Models\Produk;
use App\Models\FotoProduk;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Models\KategoriProduk;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostProdukController extends Controller
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
            $produk = Produk::with('kategori')->select('*')->orderBy('updated_at', 'desc');
            return DataTables::of($produk)
                ->addIndexColumn()
                // Mengedit kolom judul
                ->editColumn('id_kategori_produk', function ($row) {
                    return '<span class="d-block" style="max-width: 200px;">'.$row->kategori->nama.'</span>';
                })
                ->addColumn('opsi', function ($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu border border-1">
                        <li><span
                                onclick="window.location.href=\''.route('produk-post.edit', $row->id) .'\'"
                                role="button"class="dropdown-item">Edit</span></li>
                        <li><span onclick="window.location.href="
                                role="button"class="dropdown-item">Lihat</span></li>
                    </ul>
                </div>
                <form id="myForm" class="d-inline" action="'.route('produk-post.destroy', $row->id) .'"
                    method="post">
                    '.method_field('DELETE').'
                    '.csrf_field().'
                    <button onclick="deleteData()" type="button" class="btn btn-sm btn-danger"
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')"><i
                            class="bi bi-trash-fill"></i></button>
                </form>';
                })
                ->rawColumns(['opsi', 'id_kategori_produk'])
                ->toJson(true);
        }

        $data = [
            'menu' => 'Produk',
            'links' => [
                'url' => route('produk-post.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ]
        ];
        return view('produk.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'menu' => 'Produk Baru',
            'links' => [
                'url' => route('produk-post.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'kategori' => KategoriProduk::all()
        ];
        return view('produk.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdukRequest $request)
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
                    Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/produk' . '/' . $temporary->file);

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
        $produk = Produk::create([
            'nama' => $request->input('nama'),
            'slug' => $request->input('slug'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'id_kategori_produk' => $request->input('kategori'),
        ]);

        foreach ($temporaryFileName as $row) {
            FotoProduk::create([
                'id_produk' => $produk->id,
                'file' => $row
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambah data produk baru'
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
            'produk' => Produk::findOrFail($id),
            'kategori' => KategoriProduk::all()
        ];
        return view('produk.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $temporaryFolder = Session::get('image_folder');
        $temporaryFileName = Session::get('image_filename');
        // Mencari berita berdasarkan id
        $produk = Produk::find($id);

        if(Session::has('image_folder')) {
            for ($i=0; $i < count($temporaryFolder); $i++) {
                $temporary = $this->temporaryFile
                                ->where('folder', $temporaryFolder[$i])
                                ->where('file', $temporaryFileName[$i])->first();
                if ($temporary) {
                    // Mendefinisikan lokasi direktori asal file dan melakukan pemindahan file
                    $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->file;
                    if (File::exists($path)) {
                        Storage::move('files/tmp/' . $temporary->folder . '/' . $temporary->file, 'public/produk' . '/' . $temporary->file);

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
        foreach ($produk->foto as $foto) {
            $file = $foto->file;
            $filePath = storage_path('app/public/produk/' . $file);

            if (File::exists($filePath)) {
                $fotos[] = $file;
            } else {
                FotoProduk::where('file', $file)->delete();
                // echo 'file terhapus: ' . $file;
            }
        }

        $produk->foto()->delete();
        // dd($fotos);

        if ($temporaryFileName == null) {
            $newFoto = $fotos;
        } else {
            $newFoto = array_merge($fotos, $temporaryFileName);
        }

        // $newFoto = array_unique($newFoto); // Menghapus duplikasi data
        foreach ($newFoto as $row) {
            $fotoProduk = new FotoProduk();
            $fotoProduk->id_produk = $produk->id;
            $fotoProduk->file = $row;
            $fotoProduk->save();
        }

        $produk->nama = $request->input('nama');
        $produk->slug = $request->input('slug');
        $produk->deskripsi = $request->input('deskripsi');
        $produk->alamat = $request->input('alamat');
        $produk->id_kategori_produk = $request->input('kategori');
        $produk->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil memperbaharui data produk'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari data berdasarkam id
        $produk = Produk::find($id);

        foreach ($produk->foto as $foto) {
            $file = $foto->file;
            $filePath = storage_path('app/public/produk/' . $file);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $produk->foto()->delete();
        $produk->delete();
        // Mengirim response dalam bentok json
        return response()->json([
            'status' => 200,
            'message' => 'Data produk berhasil dihapus!'
        ]);
    }
}
