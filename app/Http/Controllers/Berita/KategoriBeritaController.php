<?php

namespace App\Http\Controllers\Berita;

use App\Models\KategoriBerita;
use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriBeritaRequest;
use Yajra\DataTables\Facades\DataTables;

class KategoriBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengecek request dari datatables
        if (request()->ajax()) {
            // Query tabel berita
            $kategori = KategoriBerita::select('id', 'nama')->orderBy('updated_at', 'desc');
            return DataTables::of($kategori)
                // Menambahkan index kolom urutan angka dari 1
                ->addIndexColumn()
                // Menambahkan kolom baru untuk menambahkan button edit, delete dan lainnya
                ->addColumn('opsi', function ($row) {
                    return '<div class="btn-group">
                    <button type="button" class="btn btn-sm" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu border border-1">
                        <li><span
                                onclick="window.location.href=\''.route('berita-kategori.edit', $row->id) .'\'"
                                role="button"class="dropdown-item">Edit</span></li>
                        <li><span onclick="window.location.href="
                                role="button"class="dropdown-item">Lihat</span></li>
                    </ul>
                </div>
                <form id="myForm"  class="d-inline" action="'.route('berita-kategori.destroy', $row->id) .'"
                    method="post">
                    '.method_field('DELETE').'
                    '.csrf_field().'
                    <button onclick="deleteData()" type="button"  class="btn btn-sm btn-danger"><i
                            class="bi bi-trash-fill"></i></button>
                </form>';
                })
                // Mendefinisikan kolom yang sudah ditambahkan tadi maupun kolom yang diedit
                ->rawColumns(['opsi'])
                ->toJson(true);
        }

        // Mendefinikasi data yang perlu dikirimkan ke view
        $data = [
            'menu' => 'Kategori Berita',
            'links' => [
                'url' => route('berita-kategori.create'),
                'button' => 'Buat',
                'class' => 'btn-primary'
            ]
        ];
        return view('berita.kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mendefinikasi data yang perlu dikirimkan ke view
        $data = [
            'menu' => 'Kategori Berita Baru',
            'links' => [
                'url' => route('berita-kategori.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
        ];
        return view('berita.kategori.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriBeritaRequest $request)
    {
        // Menyimpan data berita ke tabel berita
        KategoriBerita::create([
            'nama' => $request->input('nama'),
            'slug' => $request->input('slug')
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil menambahkan data kategori berita'
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
            'menu' => 'Kategori Berita Edit',
            'links' => [
                'url' => route('berita-kategori.index'),
                'button' => 'Batal',
                'class' => 'btn-danger'
            ],
            'kategori' => KategoriBerita::findOrFail($id),
        ];
        return view('berita.kategori.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriBeritaRequest $request, string $id)
    {
        // Mencari berita berdasarkan id
        $kategori = KategoriBerita::find($id);

        // Menyimpan data berita
        $kategori->nama = $request->input('nama');
        $kategori->slug = $request->input('slug');
        $kategori->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil memperbaharui data kategori berita'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari data berdasarkam id
        $kategori = KategoriBerita::find($id);
        $kategori->delete();

        // Mengirim response dalam bentok json
        return response()->json([
            'status' => 200,
            'message' => 'Data kategori berita berhasil dihapus!'
        ]);
    }
}
